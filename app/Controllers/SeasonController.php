<?php

namespace App\Controllers;

use App\Models\Season;
use App\Models\League;
use App\Models\Game;
use App\Models\Team;
use App\Models\LeagueSeason;

class SeasonController extends BaseController
{
    protected $seasonModel;
    protected $leagueModel;
    protected $gameModel;
    protected $teamModel;
    protected $leagueSeasonModel;

    public function __construct()
    {
        $this->seasonModel = new Season();
        $this->leagueModel = new League(); 
        $this->gameModel   = new Game();
        $this->teamModel   = new Team();
        $this->leagueSeasonModel = new LeagueSeason();
    }

    public function index()
    {
        $perPage = 25;

        $page = $this->request->getVar('page') ?? 1;

        $seasons = $this->seasonModel->orderBy('start', 'DESC')->paginate($perPage, 'default', $page);

        $pager = $this->seasonModel->pager;

        echo view('seasons/index', ['seasons' => $seasons,'pager' => $pager,]);
    }

    public function show($seasonId)
    {
        $season = $this->seasonModel->find($seasonId);

        // find leagues for this season via league_season pivot
        $leagues = $this->leagueModel
            ->join('league_season', 'league.id = league_season.id_league')
            ->where('league_season.id_season', $seasonId)
            ->select('league.*, league_season.id as league_season_id')
            ->findAll();

        // compute number of games per league_season so UI can show counts
            // compute number of games per league_season with a single grouped query (more reliable)
            $lsIds = array_map(fn($x) => $x->league_season_id, $leagues);
            $counts = [];
            if (!empty($lsIds)) {
                $rows = $this->gameModel
                    ->select('id_league_season, COUNT(*) as cnt')
                    ->whereIn('id_league_season', $lsIds)
                    ->groupBy('id_league_season')
                    ->findAll();

                foreach ($rows as $r) {
                    $counts[$r->id_league_season] = (int)$r->cnt;
                }
            }

            foreach ($leagues as $idx => $l) {
                $lsId = $l->league_season_id ?? null;
                $leagues[$idx]->games_count = $lsId && isset($counts[$lsId]) ? $counts[$lsId] : 0;
            }

        echo view('seasons/show', [
            'season' => $season,
            'leagues' => $leagues,
        ]);
    }

    public function matches($seasonId)
    {
        $season = $this->seasonModel->find($seasonId);
        // optional GET param 'league' (expects league_season.id) to filter
        $leagueFilter = $this->request->getGet('league');
        if (!empty($leagueFilter)) {
            $matches = $this->gameModel
                ->where('id_league_season', (int)$leagueFilter)
                ->orderBy('round', 'ASC')
                ->findAll();
        } else {
            // find all league_season ids for this season
            $ls = $this->leagueSeasonModel->where('id_season', $seasonId)->findAll();
            $lsIds = array_map(fn($x) => $x->id, $ls);

            // if no league_season entries, return empty
            if (empty($lsIds)) {
                $matches = [];
            } else {
                $matches = $this->gameModel
                    ->whereIn('id_league_season', $lsIds)
                    ->orderBy('round', 'ASC')
                    ->findAll();
            }
        }

        // load teams by id (game table uses 'home' and 'away' columns for team ids)
        $teams = [];
        foreach ($matches as $match) {
            if (!empty($match->home) && !isset($teams[$match->home])) {
                $teams[$match->home] = $this->teamModel->find($match->home);
            }
            if (!empty($match->away) && !isset($teams[$match->away])) {
                $teams[$match->away] = $this->teamModel->find($match->away);
            }
        }

        $matchesByRound = [];
        foreach ($matches as $match) {
            $matchesByRound[$match->round][] = $match;
        }

        echo view('seasons/matches', [
            'season' => $season,
            'matchesByRound' => $matchesByRound,
            'teams' => $teams,
        ]);
    }

    public function matchDetail($matchId)
    {
        $match = $this->gameModel->find($matchId);

        $homeTeam = !empty($match->home) ? $this->teamModel->find($match->home) : null;
        $awayTeam = !empty($match->away) ? $this->teamModel->find($match->away) : null;

        // Try to resolve the season id from the league_season pivot so the view can link back to season matches
        $seasonId = null;
        if (!empty($match->id_league_season)) {
            $ls = $this->leagueSeasonModel->find($match->id_league_season);
            if (!empty($ls) && !empty($ls->id_season)) {
                $seasonId = $ls->id_season;
            }
        }

        echo view('seasons/match_detail', [
            'match' => $match,
            'homeTeam' => $homeTeam,
            'awayTeam' => $awayTeam,
            'seasonId' => $seasonId,
        ]);
    }
}
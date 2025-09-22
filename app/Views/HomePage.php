<?php
// Assuming $articles is an array of articles fetched from the controller
// Each article should have 'photo', 'date', and 'title' properties

foreach ($article as $row) {
    // Convert the timestamp to a readable date format
    $formattedDate = date('j.n.Y', $row->date);
    $photoPath = 'assets/obrazky/sigma/' . $row->photo;
    $articleLink = 'article/' . strtolower(str_replace(' ', '-', $row->title));
}
?>
    <div class="ratio ratio-1x1 position-relative overflow-hidden rounded">;
        <img src="<?= base_url($photoPath) ?>" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" alt="Article Photo">
        <div class="position-absolute bottom-0 start-0 w-100 p-3" style="background: rgba(0, 0, 0, 0.5);">
            <p class="text-white mb-1"><?= $formattedDate ?></p>
            <a href="<?= base_url($articleLink) ?>" class="text-white h5 text-decoration-none"><?= $row->title ?></a>
        </div>
    </div>
    

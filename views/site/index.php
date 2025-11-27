<?php

/** @var yii\web\View $this */

$this->title = 'CINEWAVE - Películas';
?>

<!-- Hero Section -->
<div class="hero-section">
    <div class="hero-content">
        <div class="hero-badge">Nuevos</div>
        <h1 class="hero-title">Star Wars: The Force Awakens</h1>
        <div class="hero-meta">
            <span>⭐ PG-13</span>
            <span>2015</span>
            <span>2h 18m</span>
        </div>
        <p class="hero-description">
            The third season of the American television series The Mandalorian stars Pedro Pascal as the title character, a bounty hunter traveling to Mandalore to redeem his past transgressions.
        </p>
        <div class="hero-buttons">
            <button class="btn-watch">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M8 5v14l11-7z"/>
                </svg>
                Watch Trailer
            </button>
            <button class="btn-watchlist">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Add Watchlist
            </button>
        </div>
    </div>
</div>

<!-- Brand Section -->
<div class="brand-section">
    <div class="brand-container">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/08/Netflix_2015_logo.svg/340px-Netflix_2015_logo.svg.png" alt="Netflix" class="brand-logo">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/17/HBO_Max_Logo.svg/320px-HBO_Max_Logo.svg.png" alt="HBO Max" class="brand-logo">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b9/Marvel_Logo.svg/320px-Marvel_Logo.svg.png" alt="Marvel" class="brand-logo">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/Star_Wars_Logo.svg/320px-Star_Wars_Logo.svg.png" alt="Star Wars" class="brand-logo">
    </div>
</div>

<!-- Just Release Section -->
<div class="movie-section">
    <div class="section-header">
        <h2 class="section-title">Just Release</h2>
        <a href="<?= \yii\helpers\Url::to(['/pelicula/index']) ?>" class="view-all">View All →</a>
    </div>
    <div class="movie-grid">
        <?php if (!empty($movies)): ?>
            <?php foreach ($movies as $movie): ?>
                <a href="<?= \yii\helpers\Url::to(['/pelicula/view', 'idpelicula' => $movie->idpelicula]) ?>" style="text-decoration: none; color: inherit;">
                    <div class="movie-card">
                        <?php if ($movie->portada): ?>
                            <img src="<?= \yii\helpers\Url::to('@web/portadas/' . $movie->portada) ?>" alt="<?= \yii\helpers\Html::encode($movie->titulo) ?>" class="movie-poster">
                        <?php else: ?>
                            <div class="movie-poster"></div>
                        <?php endif; ?>
                        <div class="movie-info">
                            <div class="movie-title"><?= \yii\helpers\Html::encode($movie->titulo) ?></div>
                            <div class="movie-meta">
                                <span><?= $movie->año ?></span>
                                <span class="movie-rating">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <?= $movie->duracion ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: rgba(255, 255, 255, 0.5);">
                <p>No hay películas disponibles. <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin'): ?>
                    <a href="<?= \yii\helpers\Url::to(['/pelicula/create']) ?>" style="color: #10b981;">Agregar una película</a>
                <?php endif; ?></p>
            </div>
        <?php endif; ?>
    </div>
</div>

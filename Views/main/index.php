<link rel="stylesheet" href="/BDDPHP/public/assets/styles/front/home.css">

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://kinsta.com/wp-content/uploads/2018/05/what-is-php-3-1.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://kinsta.com/wp-content/uploads/2018/05/what-is-php-3-1.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://kinsta.com/wp-content/uploads/2018/05/what-is-php-3-1.png" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<section id="blog">
    <h1 class="main-title">Edouard Plantevin, le développeur qu'il vous faut!</h1>


    <div class="grid-articles">
        <?php foreach ($articles as $article): ?>
            <div class="card">
                <img src="https://kinsta.com/wp-content/uploads/2018/05/what-is-php-3-1.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text"><?= $article->title ?></p>
                    <span class="date-card"><?= date_format(new DateTime($article->created_at), 'd/m/Y') ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</section>
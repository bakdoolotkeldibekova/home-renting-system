<?php include("db.php"); ?>
<?php include("check.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <?php include("head.php"); ?>
<body>

    <?php include("nav.php"); ?>

    <section class="container mb-4">
        <div class="row no-gutters">
            <div class="col-lg-12">
                <form action="search.php">
                    <div class="form-group">
                        <input type="search" name="q" class="form-control text-truncate rounded-0" placeholder="Найти по названию ...">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <main class="container">
        <h3>Новые</h3>
        <br>
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-3 row-cols-lg-4 row-cols-xl-4">
            <?php
            $sql = "SELECT * FROM house ORDER BY date LIMIT 4";
            $result = $conn->query($sql);
            $latest_houses = $result->fetch_all(MYSQLI_ASSOC);
            ?>
            <?php foreach ($latest_houses as $house) : ?>
                <div class="col mb-4">
                    <div class="card rounded-0 border-0">
                        <img src="<?= $house['image'] ?>" alt="House image" class="card-img-top rounded-0">
                        <div class="card-body px-0 pt-1">
                            <a href="house.php?id=<?= $house['id'] ?>">
                                <p class="card-text text-justify text"><?= $house['title'] ?></p>
                            </a>
                            <h6 class="card-title pt-1">
                                <?= get_price($house['id']) ?>
                                <span class="float-right"><i class="fa <?= check_for_like($house['id']) ? 'fa-heart' : 'fa-heart-o' ?>" id="like_<?= $house['id'] ?>" onclick="like(<?= $house['id'] ?>)"></i></span>
                            </h6>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <h3>Популярные</h3>
        <br>
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-3 row-cols-lg-4 row-cols-xl-4">
            <?php
            //should be modified
            $sql = "SELECT * FROM house ORDER BY date desc LIMIT 4";
            $result = $conn->query($sql);
            $popular_houses = $result->fetch_all(MYSQLI_ASSOC);
            ?>
            <?php foreach ($popular_houses as $house) : ?>
                <div class="col mb-4">
                    <div class="card rounded-0 border-0">
                        <img src="<?= $house['image'] ?>" alt="House image" class="card-img-top rounded-0">
                        <div class="card-body px-0 pt-1">
                            <a href="house.php?id=<?= $house['id'] ?>">
                                <p class="card-text text-justify text"><?= $house['title'] ?></p>
                            </a>
                            <h6 class="card-title pt-1">
                                <?= get_price($house['id']) ?>
                                <span class="float-right"><i class="fa <?= check_for_like($house['id']) ? 'fa-heart' : 'fa-heart-o' ?>" id="like_<?= $house['id'] ?>" onclick="like(<?= $house['id'] ?>)"></i></span>
                            </h6>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

<footer class="container footer mt-auto py-3">
       
    <div >
      <ul class="socialIcons">
        <li><a href="#" class="facebook"><i class="fa fa-facebook "></i></a></li>
        <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
        <li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
        <li><a href="#" class="googlePlus"><i class="fa fa-google-plus"></i></a></li>
        <li><a href="#" class="youtube"><i class="fa fa-youtube"></i></a></li><br>
        <span class="text-muted">© Find Your Perfect Rental House. - Manas</span>
      
      </ul>
    </div>
  </footer>

    <!-- bootstrap -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- own script -->
    <script src="js/script.js" charset="utf-8"></script>
</body>
</html>

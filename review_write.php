<?php
session_start();
include('UserDB.php');

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to a login page or show an error message
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Gatti</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Navigation content... -->
    </nav>
    
    <!-- Header-->
    <header class="bg-dark py-5">
        <!-- Header content... -->
    </header>

    <!-- Section -->
    <section class="py-5">
        <div class="container-fluid px-1 px-md-4 mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="review_write_ok.php" method="post">
                        <div class="mb-3">
                            <label for="title" class="form-label">제목</label>
                            <textarea class="form-control" id="title" name="review_title" rows="1" placeholder="제목" maxlength="100" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="uname" class="col-form-label">글쓴이</label>
                            <!-- Assuming the user is already logged in, use their username -->
                            <input type="text" class="form-control" id="uname" name="review_name" value="<?php echo $_SESSION["user_name"]; ?>" maxlength="100" readonly required />
                        </div>

                        <div class="mb-3">
                            <label for="ucontent" class="form-label">내용</label>
                            <textarea class="form-control" id="ucontent" name="review_content" rows="5" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="uploadPhoto" class="col-form-label">사진 업로드</label>
                            <input type="file" class="form-control-plaintext" id="uploadPhoto" name="review_photo" accept="image/*" />
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Go!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Gatti 2023</p>
        </div>
    </footer>
    
    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- External JS file -->
    <script src="script.js"></script>
</body>
</html>

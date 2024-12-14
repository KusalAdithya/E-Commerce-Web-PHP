<?php
require "connection.php";
?>

<!DOCTYPE html>
<html>

<head>
    <title>AdiMobile | Admin | Manage Products</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/mylogo.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body class="mainbackground vh-100">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="adminpanel.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="sellerproductview.php">Manage Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add new category / model / colour</li>
                    </ol>
                </nav>
            </div>

            <div class="col-12">
                <h3 class="text-primary fw-bold">Add new category / brand / model</h3>
            </div>

            <div class="bg-primary mt-0 col-12" style="height: 10px;"></div>

            <!-- Category -->
            <div class="col-12 mb-3 mt-2">
                <div class="row g-1">

                    <div class="col-6 col-md-4 px-1" onclick="addnewmodal();">
                        <div class="row g-1 my-auto">

                            <div class="col-12 t text-dark text-center border border-primary rounded-3 " style="height: 100px; background-color: rgba(114, 170, 247, 0.932);">

                                <div class="m-2">
                                    <i class="bi bi-plus-circle fs-4"></i><br />
                                    <span class="fs-4 fw-bold"> Add New Category</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-6 col-md-4 px-1" onclick="addnewmodalb();">
                        <div class="row g-1 my-auto">

                            <div class="col-12 t text-dark text-center border border-primary rounded-3 " style="height: 100px; background-color: rgba(114, 170, 247, 0.932);">

                                <div class="m-2">
                                    <i class="bi bi-plus-circle fs-4"></i><br />
                                    <span class="fs-4 fw-bold"> Add New Brand</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-6 col-md-4 px-1" onclick="addnewmodalm();">
                        <div class="row g-1 my-auto">

                            <div class="col-12 t text-dark text-center border border-primary rounded-3 " style="height: 100px; background-color: rgba(114, 170, 247, 0.932);">

                                <div class="m-2">
                                    <i class="bi bi-plus-circle fs-4"></i><br />
                                    <span class="fs-4 fw-bold"> Add New Model</span>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!-- Modal add category-->
            <div class="modal fade" id="addnewmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Category</label>
                            <input type="text" class="form-control" id="categorytxt" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="savecategory();">Save Category</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal add Brand-->
            <div class="modal fade" id="addnewmodalb" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Brand</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Brand</label>
                            <input type="text" class="form-control" id="brandtxt" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="savebrand();">Save Brand</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal add Model-->
            <div class="modal fade" id="addnewmodalm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Model</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Model</label>
                            <input type="text" class="form-control" id="modeltxt" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="savemodel();">Save Model</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3">
                <h3 class="text-primary fw-bold">Add new model has brand</h3>
            </div>

            <div class="bg-primary mt-0 col-12" style="height: 10px;"></div>

            <!-- Add new model has brand -->
            <div class="row mx-auto justify-content-around">
                <div class="col-12 col-lg-5">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fs-4">Select Brand</label>
                        </div>
                        <div class="col-12  mb-3">
                            <select class="form-select" id="br">
                                <option value="0">Select Brand</option>
                                <?php

                                $rs = Database::search("SELECT * FROM `brand` ");
                                $n = $rs->num_rows;

                                for ($i = 0; $i < $n; $i++) {
                                    $brand = $rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $brand["id"] ?>"><?php echo $brand["name"] ?></option>
                                <?php
                                }

                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fs-4">Select Model</label>
                        </div>
                        <div class="col-12  mb-3">
                            <select class="form-select" id="mo">
                                <option value="0">Select Model</option>
                                <?php

                                $rs = Database::search("SELECT * FROM `model` ");
                                $n = $rs->num_rows;

                                for ($i = 0; $i < $n; $i++) {
                                    $model = $rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $model["id"] ?>"><?php echo $model["name"] ?></option>
                                <?php
                                }

                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-2 col-lg-2 mt-lg-4">
                    <div class="row">
                        <div class="col-12 mt-lg-3 d-grid">
                            <button class="btn btn-primary d-grid" onclick="addmodelbrand();">Add</button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12 mt-3">
                <h3 class="text-primary fw-bold">Add new colour</h3>
            </div>

            <div class="bg-primary mt-0 col-12" style="height: 10px;"></div>

            <!-- Add color -->
            <div class="col-12 mb-5 mt-2">
                <div class="row g-1 ">

                    <div class="col-6 col-md-4 px-1 mx-auto" onclick="addnewmodalc();">
                        <div class="row g-1 my-auto">

                            <div class="col-12 t text-dark text-center border border-primary rounded-3 " style="height: 100px; background-color: rgba(114, 170, 247, 0.932);">

                                <div class="m-2">
                                    <i class="bi bi-plus-circle fs-4"></i><br />
                                    <span class="fs-4 fw-bold"> Add New Colour</span>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

             <!-- Modal add Color-->
             <div class="modal fade" id="addnewmodalc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Colour</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Colour</label>
                            <input type="text" class="form-control" id="colortxt" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="savecolour();">Save Colour</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- footer -->
            <?php require "footer.php"; ?>
            <!-- footer -->
        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <!-- <script src="bootstrap.bundle.js"></script> -->
</body>

</html>
<h4 class="text-center">My Classes</h4>
<nav class="navbar bg-body-tertiary">
    <form class="container-fluid">
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
            <input type="text" class="form-control" placeholder="Search" aria-label="Username" aria-describedby="basic-addon1">
        </div>
    </form>
</nav>


<?php $rows = $student_classes; ?>

<?php include(views_path('classes')) ?>
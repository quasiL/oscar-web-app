<?php include 'includes/header.php'; ?>
<h1 class="mt-3">Home</h1>
<form action="index.php?action=display" class="row g-3 needs-validation" novalidate method="post" enctype="multipart/form-data">
    <div class="col-md-6">
        <label for="oscar_female" class="form-label">Upload Female Data</label>
        <input class="form-control" type="file" id="oscar_female" name="oscar_age_female.csv" required>
        <div class="invalid-feedback">
            Please upload the female data file.
        </div>
    </div>
    <div class="col-md-6">
        <label for="oscar_male" class="form-label">Upload Male Data</label>
        <input class="form-control" type="file" id="oscar_male" name="oscar_age_male.csv" required>
        <div class="invalid-feedback">
            Please upload the male data file.
        </div>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Upload</button>
    </div>
</form>
<?php include 'includes/footer.php'; ?>

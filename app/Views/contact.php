<?=$this->extend("_layout/master") ?>
<?=$this->section("content") ?>

<div class="container">
    <div class="row mt-4">
        <div class="offset-md-3 col-md-6">
            <h1 class="text-center">Contact Us</h1>
            <form action="" method="post" id="contactForm">
                <?=csrf_field()?>
                <div class="mb-3">
                    <label for="fname" class="form-label">First Name</label>
                    <input type="text" name="fname" id="fname" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="lname" class="form-label">Last Name</label>
                    <input type="text" name="lname" id="lname" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="number" name="phone" id="phone" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea name="message" id="message" class="form-control"></textarea>

                </div>
                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

    $("#contactForm").submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: "<?= base_url('contact/save') ?>",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {

                $('input[name="<?= csrf_token() ?>"]').val(response.csrf_token);
                if (response.status === 'error') {
                    $(".error").remove();

                    $.each(response.errors, function (key, value) {
                        $("#" + key).after('<div class="text-danger error">' + value + '</div>');
                    });

                } else {
                    alert(response.message);
                    $("#contactForm")[0].reset();
                    $(".error").remove();
                }
            }
        });

    });

});
</script>

<?=$this->endSection()?>
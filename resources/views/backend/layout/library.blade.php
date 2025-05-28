<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Demo | @yield('title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet">

    <!-- AdminLTE CSS (optional) -->
    <link rel="stylesheet" href="{{ asset('backend/css/adminlte.min.css') }}">

    <!-- Custom Alert Styling & Fixes -->
    <style>
        .alert-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            width: 80%;
            max-width: 600px;
        }

        .alert {
            display: none;
        }

        /* Fix for Summernote dropdowns */
        .note-editor .dropdown-menu {
            z-index: 2000 !important;
        }

        /* Fix for Select2 dropdown inside modal */
        .select2-container {
            z-index: 2050 !important;
        }
    </style>

</head>
<body>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initialize DataTables
            $('#productsTable').DataTable({
                pageLength: 10,
                ordering: true,
                columnDefs: [
                    { targets: 'no-sort', orderable: false }
                ]
            });

            // Search bar for table
            $('#productSearch').on('keyup', function () {
                $('#productsTable').DataTable().search(this.value).draw();
            });

            // Select2 for category dropdown
            $('.js-category-select').select2({
                placeholder: "Choose Category",
                width: '100%'
            });

            // Summernote Initialization (Short Description)
            $('#product_short_description').summernote({
                height: 100,
                placeholder: 'Enter Short Description'
            });

            // Summernote Initialization (Long Description)
            $('#product_long_description').summernote({
                height: 200,
                placeholder: 'Enter Long Description'
            });

            // Blog Content Editor (if used)
            $('#content').summernote({
                height: 300,
                placeholder: 'Write your blog content here...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                popover: {
                    image: [],
                    link: [],
                    air: []
                }
            });
        });

        $(document).ready(function () {
    // ... tumhara existing code

    // Initialize Select2 & Summernote as per your existing code
    $('.js-category-select').select2({ placeholder: "Choose Category", width: '100%' });

    $('#product_short_description').summernote({
        height: 100,
        placeholder: 'Enter Short Description'
    });

    $('#product_long_description').summernote({
        height: 200,
        placeholder: 'Enter Long Description'
    });

    // Reset button handler to clear Select2, Summernote and file inputs on reset
$('form').each(function () {
    var form = this;
    
    $(form).find('button[type="reset"]').on('click', function (e) {
        setTimeout(function () {
            // Reset text, number, email, and hidden inputs
            $(form).find('input[type="text"], input[type="number"], input[type="email"], input[type="hidden"]').val('');

            // Reset checkboxes and radio buttons
            $(form).find('input[type="checkbox"], input[type="radio"]').prop('checked', false);

            // Reset standard textareas
            $(form).find('textarea:not(.summernote)').val('');

            // Reset Select dropdowns (including Select2)
            $(form).find('select').val('').trigger('change'); // covers Select2 and others

            // Reset Summernote editors
            $(form).find('.summernote').each(function () {
                $(this).summernote('code', '');
            });

            // Reset file inputs
            $(form).find('input[type="file"]').val('');

        }, 10); // Short delay to allow native reset to finish first
    });
});

});

    </script>

</body>
</html>


{{-- <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Demo| @yield('title')</title>



<!-- Google Font: Source Sans Pro -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="{{ asset('backend/css/select2.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('backend/css/adminlte.min.css') }}">

<!-- Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('backend/css/all.min.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<!-- In the <head> tag -->
<link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css') }}" rel="stylesheet">

<style type="text/css">
    /* Center the alert on the screen */
    .alert-container {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        width: 80%;
        max-width: 600px;
    }

    /* Initially hide the alert */
    .alert {
        display: none;
    }

    <style>
  /* Fix Summernote dropdown not opening properly */
  .note-editor .dropdown-menu {
    z-index: 2000 !important;
  }
</style>

    
</style>
@section('script')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

<!-- jQuery (required for Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<!-- Select2 CSS and JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<!-- jQuery (required by Summernote) -->

<!-- Bootstrap 5 JS + Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>

<!-- Bootstrap (required for dropdowns) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- Summernote -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>

<!-- DataTables (optional if using product table search) -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {
    $('table').DataTable();
  });
</script>

<script>
    $(document).ready(function() {
        $('.js-category-select').select2({
            placeholder: "Select categories",
            width: 'resolve',
            closeOnSelect: false
        });
    });
</script>



<!-- 🧠 JavaScript Logic -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("searchCategory");
        const selectBox = document.getElementById("category_id");

        // Store all options initially
        const allOptions = Array.from(selectBox.options);

        searchInput.addEventListener("input", function () {
            const query = this.value.toLowerCase();

            // Clear current options
            selectBox.innerHTML = '';

            // Add default option
            const defaultOption = document.createElement("option");
            defaultOption.value = '';
            defaultOption.textContent = "Choose Category";
            selectBox.appendChild(defaultOption);

            // Filter and append matching options
            allOptions.forEach(option => {
                if (option.value === '') return; // skip default for now
                if (option.text.toLowerCase().includes(query)) {
                    selectBox.appendChild(option.cloneNode(true));
                }
            });
        });
    });
</script>

<script>
  $(document).ready(function() {
    var table = $('#productsTable').DataTable({
      pageLength: 10,
      ordering: true,
      columnDefs: [{ targets: 3, orderable: false }] // Prevent sorting on image column
    });

    // Custom search input binding
    $('#productSearch').on('keyup', function () {
      table.search(this.value).draw();
    });
  });
</script> 

<script>
  $(document).ready(function() {
    // Initialize DataTable with custom search
    var table = $('#productsTable').DataTable({
      pageLength: 10,
      ordering: true,
      columnDefs: [{ targets: 3, orderable: false }]
    });

    $('#productSearch').on('keyup', function () {
      table.search(this.value).draw();
    });

    // Summernote for 'product_short_description'
    $('#product_short_description').summernote({
      height: 100,
      minHeight: 50,
      placeholder: 'Enter Short Description',
      dropdownParent: $('#product_short_description').parent(),
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });

    // Summernote for 'product_long_description'
    $('#product_long_description').summernote({
      height: 200,
      minHeight: 50,
      placeholder: 'Enter Long Description',
      dropdownParent: $('#product_long_description').parent(),
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });

    // Generic Summernote (if you're using one more editor)
    $('#summernote').summernote({
      height: 300,
      minHeight: 50,
      focus: true,
      dropdownParent: $('#summernote').parent(),
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });
  });
</script>

@endsection --}}
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Demo| @yield('title')</title>



<!-- Google Font: Source Sans Pro -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="{{ asset('backend/css/select2.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('backend/css/adminlte.min.css') }}">

<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('backend/css/all.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Summernote -->
<link rel="stylesheet" href="{{ asset('backend/css/summernote-bs4.min.css') }}">

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
    
</style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
@push('scripts')
<!-- jQuery (required for Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

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

@endpush
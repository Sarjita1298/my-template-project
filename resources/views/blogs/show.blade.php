<div class="modal-header">
    <h5 class="modal-title">Blog Detail : {{ $bloginfo->title }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th style="width: 25%;">Title</th>
                    <td>{{ $bloginfo->title }}</td>
                </tr>
                <tr>
                    <th>Slug</th>
                    <td>{{ $bloginfo->slug }}</td>
                </tr>
                @if($bloginfo->image)
                <tr>
                    <th>Image</th>
                    <td>
                        <img src="{{ asset($bloginfo->image) }}" alt="{{ $bloginfo->title }}" class="img-fluid rounded" style="max-height: 100px;">
                    </td>
                </tr>
                @endif
                <tr>
                    <th>Content</th>
                    <td>{!! $bloginfo->content !!}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal-footer d-flex justify-content-between align-items-center">
    <small>Created At: {{ $bloginfo->created_at->format('d M, Y h:i A') }}</small>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>

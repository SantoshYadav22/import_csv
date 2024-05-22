<!DOCTYPE html>
<html>
<head>
    <title>Assign Groups to Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2>Assign Groups to Contact</h2>
    <a href="{{ route('view_group') }}" class="btn btn-success mb-3">View Group</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('contact-group.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="contact" class="form-label">Contact</label>
            <select id="contact" name="contact_id" class="form-control" required>
                <option value="">Select Contact</option>
                @foreach($contacts as $contact)
                    <option value="{{ $contact->id }}">{{ $contact->name }}</option>
                @endforeach
            </select>
        </div>
        <div id="load-more-container" class="mb-3">
            <button type="button" id="load-more" class="btn btn-secondary">Load More</button>
        </div>
        <div class="mb-3">
            <label for="groups" class="form-label">Groups</label>
            <select id="groups" name="group_ids[]" class="form-control" multiple required>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Assign Groups</button>
    </form>
</div>

<script>
    
$(document).ready(function(){
    let page = 1;
    
    $('#contact').on('scroll', function() {
        if ($(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight - 100) {
            page++;
            loadMoreData(page);
        }
    });
    
    $('#load-more').click(function(){
        page++;
        loadMoreData(page);
    });

    function loadMoreData(page){
        $.ajax({
            url: '?page=' + page,
            type: 'get',
            beforeSend: function(){
                $('#load-more').text('Loading...');
            }
        })
        .done(function(data){
            if(data.html == ""){
                $('#load-more').text('No more records');
                return;
            }
            $('#contact').append(data);
            $('#load-more').text('Load More');
        })
        .fail(function(jqXHR, ajaxOptions, thrownError){
            alert('Server error');
        });
    }
});
</script>
</body>
</html>

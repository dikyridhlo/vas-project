<form class="col-12 p-4" action="{{ url('customer/save') }}" method="POST" id="form">
    @csrf
    <div class="form-group">
        <label>First Name</label>
        <input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name">
    </div>
    <div class="form-group">
        <label>Last Name</label>
        <input type="text" class="form-control" id="last_name" placeholder="last_name" name="last_name">
    </div>
    <div class="form-group">
        <label>Location</label>
        <select class="form-control" id="search-location" name="location_id">
            <option value=""></option>
        </select>
    </div>
</form>
<script>
    $('#search-location').select2({
        dropdownParent: $('#CustomerModal'),
        placeholder : 'Select Location',
        ajax: {
            url: '{{ url("customer/get-location") }}',
            dataType: 'json',
            type: "GET",
            delay: 250,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                    var res = data.map(function (item) {
                        return {id: item.location_id, text: item.location_name};
                    });
                    console.log(res);
                return {
                    results: res
                };
            }
        },
    });

</script>

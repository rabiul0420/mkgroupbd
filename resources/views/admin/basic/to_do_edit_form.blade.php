<form method="POST" id="add-to-do">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">To-Do</label>
                    <input type="text" value="{{ $to_do->title }}" name="title" class="form-control title_field"
                        placeholder="To-Do">
                    <span class="text-danger to-do-error-message title_error"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Date</label>
                    <input type="text" name="to_do_date" value="{{ $to_do->to_do_date }}"
                        class="form-control flatpickr-human-friendly to_do_date_field" placeholder="Date">
                    <span class="text-danger to-do-error-message to_do_date_error"></span>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="form-group">
                    <label>Priority {!! starSign() !!}</label>
                    <select name="priority" class="form-control priority_field">
                        <option value="High" {{ $to_do->priority == "High" ? 'selected' : '' }}>High</option>
                        <option value="Medium" {{ $to_do->priority == "Medium" ? 'selected' : '' }}>Medium</option>
                        <option value="Low" {{ $to_do->priority == "Low" ? 'selected' : '' }}>Low</option>
                    </select>
                    <span class="text-danger to-do-error-message priority_error"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="submit-to-do" class="btn btn-primary">Update</button>
    </div>
</form>
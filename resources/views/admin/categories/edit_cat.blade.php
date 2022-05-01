
<div class="modal-body"> {!! Form::model($category, [
  'method' => 'PATCH',
  'files'=>true,
  'action' => ['CategoryController@update', $category->id]
  ]) !!}

  {{ csrf_field() }}

 <!-- Task Name -->
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-6">
                                <input type="text" name="title"  id="edit_name" class="form-control" value="{{ $category->title }}">
                            </div>
                        </div>


    <button type="submit" class="btn">Update</button>
    <input type="hidden" id="id" name="id">
    </form>

  </div>

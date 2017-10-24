
<div class="modal fade" id="milestones" tabindex="-1" role="dialog" aria-labelledby="milestonesModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="milestonesModalLabel">Set Milestones for project {{session('error_code')['name']}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    {{ Form::open(array('route'I have change it => array('projects.milestones.store','project'=>session('error_code')['id']),'method'=>'POST')) }}
    {{Form::token()}}
        <div class="modal-body">
        <input type="text" hidden value="5" name="question" id="question">
            <div class="row">
                <div class="form-group col-md-6">
                    {{Form::label('percentage', 'Percentage:')}} 
                    <input type="number" min="0" max="100" step="any" class="form-control" name="percentage" id="percentage">
                </div>
                <div class="form-group col-md-6">
                    {{Form::label('due_to', 'Due to:')}} 
                    <input class="datepicker form-control" name="due_to" id="due_to">
                </div>
                <button type="button" class="btn btn-success form-control" id="add-to-list">Add milestone</button>
            </div>
        </div>
        <ul class="list-group" >
            <li class="list-group-item">
                <div id="milestones-list">
                    
                </div>
            </li>
        </ul>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" id="create-milestones" disabled>Create response</button>
        </div>
    {{Form::close()}}
    @include('layout.errors')
    </form>
    </div>
</div>
</div>

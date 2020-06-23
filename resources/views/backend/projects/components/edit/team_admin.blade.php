<div class="row justify-content-center empty-values-finish-add-crew">

    <div class="col-md-6">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Función Frame<span class="required-red">*</span>
        </span>
        <select class="selectpicker project-edit get_value_frame_functions ajax_categories_sat_by_function_frame ajax_crew_by_function_frame" data-live-search="true" data-style="select-with-transition" name="id_function_frame">
            <option value="">Seleccionar</option>
            @foreach(\App\FrameFunction::getAllFrameFunctionByTypeProject($project->id_proyect_category) as $f_frame)
            <option value="{{ $f_frame->id }}">{{ $f_frame->name }}</option>
            @endforeach
        </select>
        </div>
    </div>
    </div>

    <div class="col-md-6">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Categoría SAT<span class="required-red">*</span>
        </span>
        <select class="selectpicker get_value_categories_sat event_toggle_category_sat" data-live-search="true" data-style="select-with-transition" name="id_category_sat">
            <option value="">Seleccionar</option>
        </select>
        </div>
    </div>
    </div>

    <div class="col-md-6">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Team<span class="required-red">*</span>
        </span>
        <select class="selectpicker get_value_crew" data-live-search="true" data-style="select-with-transition" name="id_provider">
            <option value="">Seleccionar</option>
        </select>
        </div>
    </div>
    </div>

    <div class="col-md-6">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Tipo de Contrato<span class="required-red">*</span>
        </span>
            <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name="id_contract" onchange="getContractProject(this.value)">
            <option value="">Seleccionar</option>
            @foreach(\App\Contract::getAllContracts('1') as $contract)
            <option value="{{ $contract->id }}">{{ $contract->name }}</option>
            @endforeach
        </select>
        </div>
    </div>
    </div>

    <div class="col-md-6">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Fecha de Alta Contrato<span class="required-red">*</span>
        </span>
        <input class="form-control datepicker_crew" type="text" name="start_date_contract">
        </div>
    </div>
    </div>

    <div class="col-md-6">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Fecha de Baja Contrato<span class="required-red">*</span>
        </span>
        <input class="form-control datepicker_crew" type="text" name="finish_date_contract">
        </div>
    </div>
    </div>

    <input type="hidden" name="days_crew" value="" />

    <div class="col-md-6">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Modalidad<span class="required-red">*</span>
        </span>
        <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name="id_workday">
            <option value="">Seleccionar</option>
            @foreach(\App\Workday::getAllWorkdays() as $workday)
            <option value="{{ $workday->id }}" data-mode="{{ $workday->mode }}">{{ $workday->name }}</option>
            @endforeach
        </select>
        </div>
    </div>
    </div>

    <div class="col-md-6">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Cant. Jornadas Laborables<span class="required-red">*</span>
        </span>
            <input type="number" class="form-control input-type-number" name="count_workdays_crew" maxlength="125">
        </div>
    </div>
    </div>

    <div class="col-md-6">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Hora de Inicio<span class="required-red" style="margin-right: 4px;">*</span>
        </span>
        <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name="hour_initial">
        </select>
        </div>
    </div>
    </div>

    <div class="col-md-6">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Hora Final<span class="required-red" style="margin-right: 4px;">*</span>
        </span>
        <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name="hour_end">
        </select>
        </div>
    </div>
    </div>

    <div class="col-md-6 field-afip">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Fecha de Alta AFIP:
        </span>
        <input class="form-control datepicker" type="text" name="start_afip">
        </div>
    </div>
    </div>

    <div class="col-md-6 field-afip">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Fecha de Baja AFIP:
        </span>
        <input class="form-control datepicker" type="text" name="finish_afip">
        </div>
    </div>
    </div>

    <div class="col-md-6 fields-secure" style="display: none">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Fecha de Alta SEGURO:
        </span>
        <input class="form-control datepicker" type="text" name="start_date_secure_contract">
        </div>
    </div>
    </div>

    <div class="col-md-6 fields-secure" style="display: none">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Fecha de Baja SEGURO:
        </span>
        <input class="form-control datepicker" type="text" name="end_date_secure_contract">
        </div>
    </div>
    </div>

    <div class="col-md-6">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Sueldo Jornada<span class="required-red" style="margin-right: 4px;">*</span> $
        </span>
            <input type="text" class="form-control validate-number-decimal-not-ps" name="salary_workdays" maxlength="125">
        </div>
    </div>
    </div>

    <div class="col-md-6">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Sueldo en mano $
        </span>
            <input type="text" class="form-control" name="total_workdays" maxlength="125" placeholder="Click aquí para que actualizar los Sueldos" readonly>
        </div>
    </div>
    </div>

    <div class="col-md-6">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Sueldo en mano Texto<span class="required-red">*</span>
        </span>
        <input type="text" class="form-control" name="total_workdays_text" maxlength="125">
        </div>
    </div>
    </div>

    <div class="col-md-6">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text sueldo_contrato_team">
            Sueldo Contrato Bruto
        </span>
        <input type="text" class="form-control" name="salary_contract_bruto_category_function" maxlength="125" readonly>
        <input type="hidden" class="form-control" name="salary_contract_category_function" maxlength="125" readonly>
        </div>
    </div>
    </div>

    <div class="col-md-6">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Sueldo Diario SAT $
        </span>
            <input type="text" class="form-control" name="salary_daily" maxlength="125" readonly>
        </div>
    </div>
    </div>

    <input type="hidden" name="id_project_provider" maxlength="125" readonly>
    <input type="hidden" name="salary_liquidate" maxlength="125" readonly>

    <div class="col-md-6">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Diferencia $
        </span>
        <input type="text" class="form-control" name="crew_sueldo_diferencia" maxlength="125" readonly>
        </div>
    </div>
    </div>

    <div class="col-md-6">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Es Reemplazo:
        </span>
        @if(count($list_crew) > 0)
            <select class="selectpicker" data-style="select-with-transition" name="is_reemplazo">
        @else
            <select class="selectpicker" data-style="select-with-transition" name="is_reemplazo" disabled>
        @endif
            <option value="1" selected>No</option> <!-- 1 = Titular -->
            <option value="2">Si</option> <!-- 1 = Suplente -->
        </select>
        </div>
    </div>
    </div>

    <div class="col-md-6">
    <div class="form-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
            Reemplazo del Team:
        </span>
        <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name="id_crew_reemplazo">
            <option value="0">Seleccionar</option>
            @if(count($list_crew) > 0)
            @foreach($list_crew as $item_crew)
                <!-- 1: titular -->
                @if($item_crew->is_reemplazo == "1")
                <option value="{{ $item_crew->id_provider }}" <?php if(\App\ProjectProvider::hasReemplazo($item_crew->id_provider)){ echo "style='background: #5cb85c; color: #fff;'"; } ?> >{{ \App\Provider::getNameOrderLastName($item_crew->id_provider) }}</option>
                @endif
            @endforeach
            @endif
        </select>
        </div>
    </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
            Estado de Invitacion al Proyecto:
            </span>
            <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name="active">
            <option value="1">Aceptado</option>
            <option value="0">Pendiente</option>
            <option value="2">Rechazado</option>
            </select>
        </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">

        </div>
    </div>
    <div class="col-md-12 text-center" style="padding: 20px;">
    <button id="add_crew" type="button" class="btn btn-primary">Agregar Team</button>
    <input id="is_edit" type="hidden" value="0" />
    </div>
</div>
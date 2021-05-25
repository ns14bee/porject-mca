<?php use Request as Input; ?>
<div class="kt-portlet__body">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Name</label>
                {!! Form::text('name',Input::old('name'), ['class' => 'form-control','id'=>"name",'name'=>'name','placeholder'=>'Enter name']) !!} 
            </div>
        </div>                            
        <div class="col-md-3">
            <div class="form-group">
                <label>Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/png,image/jpg,image/jpeg">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Price</label>
                {!! Form::text('price',Input::old('price'), ['class' => 'form-control','id'=>"price",'name'=>'price','placeholder'=>'Enter price']) !!} 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Brand</label>
                {!! Form::text('brand',Input::old('brand'), ['class' => 'form-control','id'=>"brand",'name'=>'brand','placeholder'=>'Enter brand']) !!} 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Installation Type</label>
                {!! Form::text('installation_type',Input::old('installation_type'), ['class' => 'form-control','id'=>"installation_type",'name'=>'installation_type','placeholder'=>'Enter installation type']) !!} 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Industry</label>
                {!! Form::text('industry',Input::old('industry'), ['class' => 'form-control','id'=>"industry",'name'=>'industry','placeholder'=>'Enter industry']) !!} 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Water Source</label>
                {!! Form::text('water_source',Input::old('water_source'), ['class' => 'form-control','id'=>"water_source",'name'=>'water_source','placeholder'=>'Enter water source']) !!} 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Water Storage Capacity</label>
                {!! Form::text('water_storage_capacity',Input::old('water_storage_capacity'), ['class' => 'form-control','id'=>"water_storage_capacity",'name'=>'water_storage_capacity','placeholder'=>'Enter water storage capacity']) !!} 
            </div>
        </div>                            
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Working Pressure</label>
                {!! Form::text('working_pressure',Input::old('working_pressure'), ['class' => 'form-control','id'=>"working_pressure",'name'=>'working_pressure','placeholder'=>'Enter working pressure']) !!} 
            </div>
        </div>
        <!-- <div class="col-md-3">
            <div class="form-group">
                <label>Brand</label>
                {!! Form::text('brand',Input::old('brand'), ['class' => 'form-control','id'=>"brand",'name'=>'brand','placeholder'=>'Enter brand']) !!} 
            </div>
        </div> -->
                 
        <div class="col-md-3">
            <div class="form-group">
                <label>Phase</label>
                {!! Form::text('phase',Input::old('phase'), ['class' => 'form-control','id'=>"phase",'name'=>'phase','placeholder'=>'Enter phase']) !!} 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Capacity</label>
                {!! Form::text('capacity',Input::old('capacity'), ['class' => 'form-control','id'=>"capacity",'name'=>'capacity','placeholder'=>'Enter capacity']) !!} 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Usage Application</label>
                {!! Form::text('usage_application',Input::old('usage_application'), ['class' => 'form-control','id'=>"usage_application",'name'=>'usage_application','placeholder'=>'Enter usage application']) !!} 
            </div>
        </div>                            
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Product range</label>
                {!! Form::text('product_range',Input::old('product_range'), ['class' => 'form-control','id'=>"product_range",'name'=>'product_range','placeholder'=>'Enter product range']) !!} 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Flow rate</label>
                {!! Form::text('flow_rate',Input::old('flow_rate'), ['class' => 'form-control','id'=>"flow_rate",'name'=>'flow_rate','placeholder'=>'Enter flow rate']) !!} 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Voltage</label>
                {!! Form::text('voltage',Input::old('voltage'), ['class' => 'form-control','id'=>"voltage",'name'=>'voltage','placeholder'=>'Enter voltage']) !!} 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Frequency</label>
                {!! Form::text('frequency',Input::old('frequency'), ['class' => 'form-control','id'=>"frequency",'name'=>'frequency','placeholder'=>'Enter frequency']) !!} 
            </div>
        </div>                            
    </div>
</div>
<hr>
<div class="kt-portlet__body">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Frequency range</label>
                {!! Form::text('frequency_range',Input::old('frequency_range'), ['class' => 'form-control','id'=>"frequency_range",'name'=>'frequency_range','placeholder'=>'Enter frequency range']) !!} 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Power source</label>
                {!! Form::text('power_source',Input::old('power_source'), ['class' => 'form-control','id'=>"power_source",'name'=>'power_source','placeholder'=>'Enter power source']) !!} 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Minimum order quantity</label>
                {!! Form::text('minimum_order_quantity',Input::old('minimum_order_quantity'), ['class' => 'form-control','id'=>"minimum_order_quantity",'name'=>'minimum_order_quantity','placeholder'=>'Enter minimum order quantity']) !!} 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Material</label>
                {!! Form::text('material',Input::old('material'), ['class' => 'form-control','id'=>"material",'name'=>'material','placeholder'=>'Enter material']) !!} 
            </div>
        </div>                            
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Purification capacity</label>
                {!! Form::text('purification_capacity',Input::old('purification_capacity'), ['class' => 'form-control','id'=>"purification_capacity",'name'=>'purification_capacity','placeholder'=>'Enter purification capacity']) !!} 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Capacity inlet flow rate</label>
                {!! Form::text('capacity_inlet_flow_rate',Input::old('capacity_inlet_flow_rate'), ['class' => 'form-control','id'=>"capacity_inlet_flow_rate",'name'=>'capacity_inlet_flow_rate','placeholder'=>'Enter capacity inlet flow rate']) !!} 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>type of purification plants</label>
                {!! Form::text('type_of_purification_plants',Input::old('type_of_purification_plants'), ['class' => 'form-control','id'=>"type_of_purification_plants",'name'=>'type_of_purification_plants','placeholder'=>'Enter type of purification plants']) !!} 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Water yield</label>
                {!! Form::text('water_yield',Input::old('water_yield'), ['class' => 'form-control','id'=>"water_yield",'name'=>'water_yield','placeholder'=>'Enter water yield']) !!} 
            </div>
        </div>                            
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Recovery</label>
                {!! Form::text('recovery',Input::old('recovery'), ['class' => 'form-control','id'=>"recovery",'name'=>'recovery','placeholder'=>'Enter recovery']) !!} 
            </div>
        </div>  
        <div class="col-md-3">
            <div class="form-group">
                <label>Desalination rate</label>
                {!! Form::text('desalination_rate',Input::old('desalination_rate'), ['class' => 'form-control','id'=>"desalination_rate",'name'=>'desalination_rate','placeholder'=>'Enter desalination rate']) !!} 
            </div>
        </div>  
        <div class="col-md-3">
            <div class="form-group">
                <label>quality</label>
                {!! Form::text('quality',Input::old('quality'), ['class' => 'form-control','id'=>"quality",'name'=>'quality','placeholder'=>'Enter quality']) !!} 
            </div>
        </div>  
        <div class="col-md-3">
            <div class="form-group">
                <label>colour</label>
                {!! Form::text('colour',Input::old('colour'), ['class' => 'form-control','id'=>"colour",'name'=>'colour','placeholder'=>'Enter colour']) !!} 
            </div>
        </div>   
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Size dimension</label>
                {!! Form::text('size_dimension',Input::old('size_dimension'), ['class' => 'form-control','id'=>"size_dimension",'name'=>'size_dimension','placeholder'=>'Enter size dimension']) !!} 
            </div>
        </div>  
        <div class="col-md-3">
            <div class="form-group">
                <label>Sterilization for</label>
                {!! Form::text('sterilization_for',Input::old('sterilization_for'), ['class' => 'form-control','id'=>"sterilization_for",'name'=>'sterilization_for','placeholder'=>'Enter Sterilization for']) !!} 
            </div>
        </div>  
        <div class="col-md-3">
            <div class="form-group">
                <label>Service location</label>
                {!! Form::text('service_location',Input::old('service_location'), ['class' => 'form-control','id'=>"service_location",'name'=>'service_location','placeholder'=>'Enter service location']) !!} 
            </div>
        </div> 
        <div class="col-md-3">
            <div class="form-group">
                <label>Service mode</label>
                {!! Form::text('service_mode',Input::old('service_mode'), ['class' => 'form-control','id'=>"service_mode",'name'=>'service_mode','placeholder'=>'Enter service mode']) !!} 
            </div>
        </div>  
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Service duration</label>
                {!! Form::text('service_duration',Input::old('service_duration'), ['class' => 'form-control','id'=>"service_duration",'name'=>'service_duration','placeholder'=>'Enter service duration']) !!} 
            </div>
        </div>   
        <div class="col-md-3">
            <div class="form-group">
                <label>Description</label>
                {!! Form::textarea('description',Input::old('description'), ['class' => 'form-control','id'=>"description", 'rows' => 2,'name'=>'description','placeholder'=>'Enter Descriptions']) !!} 
            </div>
        </div>
    </div>
</div>
<div class="kt-portlet__foot">
    <div class="kt-form__actions ">
        @if(isset($data->id))
            <button type="submit" class="btn btn-primary submitbutton">Update</button>
        @else
            <button type="submit" class="btn btn-primary submitbutton">Save</button>
        @endif
        <a href="{{route('product.index')}}"><button type="button" class="btn btn-secondary cancelbutton">Cancel</button></a>
    </div>
</div>
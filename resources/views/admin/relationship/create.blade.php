@extends('admin.index')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="widget-extra body-req portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject bold uppercase font-dark">{{$title}}</span>
				</div>
				<div class="actions">
					<a  href="{{aurl('relationship')}}"
						class="btn btn-circle btn-icon-only btn-default"
						tooltip="{{trans('admin.show_all')}}"
						title="{{trans('admin.show_all')}}">
						<i class="fa fa-list"></i>
					</a>
					<a class="btn btn-circle btn-icon-only btn-default fullscreen"
						href="#"
						data-original-title="{{trans('admin.fullscreen')}}"
						title="{{trans('admin.fullscreen')}}">
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="col-md-12">
                    {!! Form::open(['url'=>aurl('/relationship'),'id'=>'relationship','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
                    <div class="form-group" style="    border-bottom: none !important;
">
                        <div class="col-md-3">
                            {!! Form::label('re_name',trans('admin.re_name'),['class'=>'control-label']) !!}
							{!! Form::text('re_name',old('re_name'),['class'=>'form-control','placeholder'=>trans('admin.re_name')]) !!}
						</div>
					</div>
					<br>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class=" col-md-12">
										{!! Form::submit(trans('admin.add'),['class'=>'btn btn-success']) !!}
									</div>
								</div>
							</div>
						</div>
					</div>
					{!! Form::close() !!}
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
@stop

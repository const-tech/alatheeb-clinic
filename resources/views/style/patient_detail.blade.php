<?php
foreach ($patient as $item) { ?>
<div class="col-md-3">
        <input type="hidden" class="form-control" id="natio"  value="<?=$item->nationality;?>" disabled>
</div>
<h5 style="padding: 5px;">
    {{trans('admin.patient_name')}}: <span
        style="font-size: 14px;border: none;padding: 3px; background: #36c6d3 !important;color: #fff;font-weight: bold;"> <?=$item->first_name;?></span>
</h5>
<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'tashkhees')">{{trans('admin.Current diagnosis')}}</button>
    <button class="tablinks" onclick="openCity(event, 'isdar')">{{trans('admin.Issuing an invoice')}}</button>
    <button class="tablinks" onclick="openCity(event, 'bayanat')">{{trans('admin.Patient data')}}</button>
{{--    <button class="tablinks" onclick="openCity(event, 'sabiqa')">تشخيصات سابقة</button>--}}
    <a class="tablinks" target="_blank" href="{{route('doctor.diagnosis')}}?patient_id={{$item->id}}">{{trans('admin.previous diagnoses')}}</a>
    <button class="tablinks" onclick="openCity(event, 'tahweel')">{{trans('admin.Transfer the patient')}}</button>
{{--    <button class="tablinks" onclick="openCity(event, 'files')">اضف ملفات للمريض</button>--}}
</div>
<div id="files" class="tabcontent">
    <h4>اضف ملفات للمريض</h4>
    <form class="form-body" action="{{url("doctor/patient/$item->id/files")}}" method="post"
          enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="patient_id" value="{{$item->id}}">
        <div class="form-group">
            <label for="">المسمي</label>
            <input class="form-control" name="file_name" type="text">
        </div>
        <div class="form-group">
            <label for="">الملفات</label>
            <input class="form-control" name="files[]" type="file">
        </div>
        <button class="btn btn-primary">اضافة</button>
    </form>
</div>
<div id="tashkhees" class="tabcontent">
    التشخيص : <textarea class="form-control" name="tratment" id="tratment"
                        placeholder="يعنى من الم في الاسنان....."></textarea>
    الاجراء المتخذ : <textarea class="form-control" id="taken" name="taken"></textarea></br>
    <section class="num-teeth">
        <div class="toothArray content ">
            <img class="img-teeth" src="{{ asset('num.png') }}" alt="" />
            <input type="checkbox" name="tooth" id="" value="18">
            <input type="checkbox" name="tooth" id="" value="17">

            <input type="checkbox" name="tooth" id="" value="16">

            <input type="checkbox" name="tooth" id="" value="15">
            <input type="checkbox" name="tooth" id="" value="14">
            <input type="checkbox" name="tooth" id="" value="13">
            <input type="checkbox" name="tooth" id="" value="12">
            <input type="checkbox" name="tooth" id="" value="11">
            <input type="checkbox" name="tooth" id="" value="21">
            <input type="checkbox" name="tooth" id="" value="22">
            <input type="checkbox" name="tooth" id="" value="23">
            <input type="checkbox" name="tooth" id="" value="24">
            <input type="checkbox" name="tooth" id="" value="25">
            <input type="checkbox" name="tooth" id="" value="26">
            <input type="checkbox" name="tooth" id="" value="27">
            <input type="checkbox" name="tooth" id="" value="28">
            <input type="checkbox" name="tooth" id="" value="38">
            <input type="checkbox" name="tooth" id="" value="37">
            <input type="checkbox" name="tooth" id="" value="36">
            <input type="checkbox" name="tooth" id="" value="35">
            <input type="checkbox" name="tooth" id="" value="34">
            <input type="checkbox" name="tooth" id="" value="33">
            <input type="checkbox" name="tooth" id="" value="32">
            <input type="checkbox" name="tooth" id="" value="31">
            <input type="checkbox" name="tooth" id="" value="41">
            <input type="checkbox" name="tooth" id="" value="42">
            <input type="checkbox" name="tooth" id="" value="43">
            <input type="checkbox" name="tooth" id="" value="44">
            <input type="checkbox" name="tooth" id="" value="45">
            <input type="checkbox" name="tooth" id="" value="46">
            <input type="checkbox" name="tooth" id="" value="47">
            <input type="checkbox" name="tooth" id="" value="48">
        </div>
    </section>
</div>

<div id="isdar" class="tabcontent">
    <div class="row">
        <div class="col-md-3">
            التصنيف :
            <select class="form-control" id="cat_id" onclick="get_products()">
                <option value="">اختر التصنيف</option>
                @foreach($category AS $cat)
                    <option value="{{ $cat->id }}">{{ $cat->cat_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            الخدمة :
            <select class="form-control" id="product_id" onchange="add_item_invoice()">

            </select>
        </div>
        <div class="col-md-2">
            الالإجمالي <h1 id="t_total">0</h1>
        </div>
        @user_can("specials-payments")
        <div class="col-md-2">
            تقصيد الفاتورة <input type="number" min="1" name="payments" value="1" id="payments">
        </div>
@end_user_can
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>اسم التصنيف</th>
                    <th>اسم الخدمة</th>
                    <th>السعر</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="msg">

                </tbody>
            </table>
        </div>
        <form action="{{ route('session_canceled') }}" method="POST">
            @csrf
            <input type="hidden" name="appoint_id" value="{{ $appoint_id }}" id="">
            <input type="hidden" name="patient_id" value="{{ $item->id }}" id="">
            <input type="hidden" name="appoint_status" value="6" id="">
            <input type="hidden" name="attend_status" value="attended" id="">

            <button type="submit" class="btn mb-2  pull-right btn-danger btn-lg  ">الغاء الجلسة</button>
        </form>
        <button class="btn btn-success pull-right pull-xs-left mb-2" onclick="save_treatment('<?=$item->id;?>','<?=$appoint_id;?>')">حفظ التشخيص
            وانهاء الجلسة
        </button>

    </div>
</div>
<div id="bayanat" class="tabcontent">
    <div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>رقم السجل</th>
            @user_can("specials-read_id_number")
            <th>رقم الهوية / الاقامة</th>
            @end_user_can
            <th>اسم المريض</th>
            <th>رقم الجوال</th>
            <th></th>
        </tr>
        <tr>
            <td><?=$item->id;?></td>
            @user_can("specials-read_id_number")
            <td><?=$item->civil;?></td>
            @end_user_can
            <td><?=$item->first_name;?></td>
            @user_can("specials-read_phone_number")
            <td><?=$item->mobile;?></td>
            @end_user_can
            <td><a href="{{url('/doctor/patients/'.$item->id)}}" class="btn btn-info btn-sm">كامل البيانات</a></td>
        </tr>
    </table>
    </div>

</div>
{{--<div id="sabiqa" class="tabcontent">--}}
{{--    @php--}}
{{--    $table = new \App\DataTables\DiagnosisDataTable();--}}
{{--    @endphp--}}
{{--    {!! $table->render('doctor.datatables_show',['title'=>"اخر التشخيصات"]) !!}--}}

{{--</div>--}}
<div id="tahweel" class="tabcontent">

    <div class="col-md-12">
        تحويل الي طبيب آخر
        <table class="table table-bordered">
            <tr>
                <th>العيادة</th>
                <th>الطبيب</th>
                <th></th>
            </tr>
            <tr>
                <td>
                    <select name="dep_id" id="dep_id" class="form-control" onchange="get_doctors()">
                        <option value="">اختر العيادة</option>
                        @foreach($departments AS $dep)
                            <option value="{{ $dep->id }}">{{ $dep->dep_name }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td><select class="form-control" id="doctors">

                    </select></td>
                <td>
                    @user_can("specials-transfer_patients")
                    <button type="button" class="btn btn-primary"
                            onclick="tahweel_patient('<?=$item->id;?>','<?=$appoint_id;?>','<?=$doctor_current;?>');">
                        تحويل
                    </button>
                    @end_user_can
                </td>


            </tr>
        </table>
    </div>

</div>
<?php
	 }
	 ?>

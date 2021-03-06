
@extends('backend.layouts.app')
@section('content')
@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        @if($error == 'Vui lòng chọn học kỳ')
            <script>
                $(document).ready(function(){
                    $('.msn_id_semester').select2({ containerCssClass : "is-invalid" , placeholder: "Vui lòng chọn"});
                });
            </script>
        @endif
        @if($error == 'Vui lòng chọn học phần')
            <script>
                $(document).ready(function(){
                    $('.msn_id_term').select2({ containerCssClass : "is-invalid" , placeholder: "Vui lòng chọn"});
                });
            </script>
        @endif
        @if($error == 'Vui lòng chọn lớp')
            <script>
                $(document).ready(function(){
                    $('.msn_id_class').select2({ containerCssClass : "is-invalid" , placeholder: "Vui lòng chọn"});
                });
            </script>
        @endif
    @endforeach
@endif
<section class="content">
    <form method="POST" id="submit-form" action="{{route('mst_mission.editPost',['id'=>$mstMisstion['id']])}}" class="form-horizontal">      @csrf
      <div class="row">
        <div class="col-md-9">
          <!-- general form elements -->
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">{{trans('labels.backend.mst_mission.edit')}}</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                @include('includes.error')
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">{{trans('labels.backend.mst_mission.form.semester')}}</label>
                            <div class="col-sm-8">
                                <select disabled class="form-control msn_id_semester select2 @error('msn_id_semester') is-invalid @enderror" style="width: 100%;height:100%"  name="msn_id_semester">
                                    @foreach($dataDefault['MstSemester'] as $k => $val)
                                        <option value="{{$k}}" {{(old('msn_id_semester',$mstMisstion['msn_id_semester']) == $k) ? 'selected' : ''}}>{{$val}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">{{trans('labels.backend.mst_mission.form.batch')}}</label>
                            <div class="col-sm-8">
                                <select  disabled class="form-control msn_batch @error('msn_batch') is-invalid @enderror" name="msn_batch">
                                    @foreach($dataDefault['MsnBatch'] as $k => $val)
                                        <option value="{{$k}}" {{(old('msn_batch',$mstMisstion['msn_batch']) == $k) ? 'selected' : ''}}>{{$val}}</option>
                                    @endforeach
                                </select>
                                <!-- <input type="text" class="form-control @error('msn_batch') is-invalid @enderror" value="{{ old('msn_batch') }}" name="msn_batch" placeholder="Đợt"> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">{{trans('labels.backend.mst_mission.form.term')}}</label>
                            <div class="col-sm-8">
                                <select class="form-control msn_id_term select-mst-title select2 @error('msn_id_term') is-invalid @enderror" name="msn_id_term">
                                    @foreach($dataDefault['MstTerm'] as $k => $val)
                                        <option value="{{$k}}" {{(old('msn_id_term',$mstMisstion['msn_id_term']) == $k) ? 'selected' : ''}}>{{$val}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">{{trans('labels.backend.mst_mission.form.class')}}</label>
                            <div class="col-sm-8">
                                <select class="form-control msn_id_class select-mst-title select2 @error('msn_id_class') is-invalid @enderror" name="msn_id_class">
                                    @foreach($dataDefault['MstClass'] as $k => $val)
                                        <option value="{{$k}}" {{(old('msn_id_class',$mstMisstion['msn_id_class']) == $k) ? 'selected' : ''}}>{{$val}}</option>
                                    @endforeach
                                </select>
                                @if(old('msn_batch') == 12 || old('msn_batch') == 7 || ($mstMisstion['msn_batch'] == 12 || $mstMisstion['msn_batch'] == 7))
                                    <input type="text" class="form-control cls_name @error('cls_name') is-invalid @enderror" value="{{ old('cls_name',$mstMisstion['msn_cls_name']) }}" name="cls_name" id="inputEmail3" placeholder="Nhập tên lớp">
                                @else 
                                    <input type="hidden" class="form-control cls_name @error('cls_name') is-invalid @enderror" value="{{ old('cls_name',$mstMisstion['msn_cls_name']) }}" name="cls_name" id="inputEmail3" placeholder="Nhập tên lớp">
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-sm-8">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">{{trans('labels.backend.mst_mission.form.count_student')}}</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Số sinh viên">
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">{{trans('labels.backend.mst_class.form.count_studen')}}</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('cls_count_student') is-invalid @enderror" value="{{ old('cls_count_student',$mstMisstion['msn_cls_count_student']) }}" name="cls_count_student" id="inputEmail3" placeholder="Nhập số sinh viên">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">{{trans('labels.backend.mst_class.form.coefficien')}}</label>
                            <div class="col-sm-8">
                                <span class="span_cls_coefficient">{{$mstMisstion['msn_cls_coefficient']}}</span>
                                <input type="hidden" class="form-control @error('cls_coefficient') is-invalid @enderror" value="{{ old('cls_coefficient',$mstMisstion['msn_cls_coefficient']) }}" name="cls_coefficient" id="inputEmail3" placeholder="Nhập hệ số">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">{{trans('labels.backend.mst_mission.form.date_lesson')}}</label>
                            <div class="col-sm-8">
                                <select class="form-control select-mst-title @error('msn_learn') is-invalid @enderror" name="msn_learn">
                                    @foreach($dataDefault['MsnLearn'] as $k => $val)
                                        <option value="{{$k}}" {{(old('msn_learn',$mstMisstion['msn_learn']) == $k) ? 'selected' : ''}}>{{$val}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">{{trans('labels.backend.mst_mission.form.lesson')}}</label>
                            <div class="col-sm-8">
                                <input type="text" placeholder="Tiết học" class="form-control @error('msn_lesson') is-invalid @enderror" value="{{ old('msn_lesson',$mstMisstion['msn_lesson']) }}" name="msn_lesson">
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <!-- <div class="col-sm-8">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">{{trans('labels.backend.mst_mission.form.room_learn')}}</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('msn_teach_room') is-invalid @enderror" value="{{ old('msn_teach_room',$mstMisstion['msn_teach_room']) }}" name="msn_teach_room" placeholder="Phòng học">
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="row">
                    <!-- <div class="col-sm-8">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">{{trans('labels.backend.mst_mission.form.teach')}}</label>
                            <div class="col-sm-8">
                                <select class="form-control select-mst-title @error('msn_type_teach') is-invalid @enderror" name="msn_type_teach">
                                    @foreach($dataDefault['MsnTypeTech'] as $k => $val)
                                        <option value="{{$k}}" {{(old('msn_type_teach',$mstMisstion['msn_type_teach']) == $k) ? 'selected' : ''}}>{{$val}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="col-sm-8">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">{{trans('labels.backend.mst_mission.form.date_teach')}}</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="input-group date">
                                            <div class="input-group-addon @error('msn_date_teach_start') is-invalid @enderror">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right @error('msn_date_teach_start') is-invalid @enderror" value="{{ old('msn_date_teach_start',date("d/m/Y", strtotime(str_replace('/', '-', $mstMisstion['msn_date_teach'])))) }}" name="msn_date_teach_start" id="datepicker">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group date">
                                            <div class="input-group-addon @error('msn_date_teach_end') is-invalid @enderror">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right @error('msn_date_teach_end') is-invalid @enderror" value="{{ old('msn_date_teach_end') }}" name="msn_date_teach_end" id="datepicker_end_date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">{{trans('labels.backend.mst_mission.form.des')}}</label>
                            <div class="col-sm-8">
                                <textarea  class="form-control @error('msn_describe') is-invalid @enderror"  name="msn_describe" rows="4" cols="50">{{ old('msn_describe',$mstMisstion['msn_describe']) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="box-footer">
                <button type="submit" class="btn btn-primary margin pull-right"><i class="fa fa-save"></i>{{trans('labels.backend.common.back')}}</button>
            </div> -->
              <!-- /.box-body -->
          </div>
          <!-- /.box -->
            <!-- /.box-body -->
          <!-- /.box -->
        </div>
        <!-- left column -->
        <div class="col-md-3">
        <div class="box box-primary box-solid">
            <div class="box-header">
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-app btn-save-app">
                            <i class="fa fa-save"></i> {{trans('labels.backend.common.save')}}
                        </button>
                    </div>
                    <div class="col-sm-6">
                        <a class="btn btn-app" href="{{route('mst_mission.index')}}">
                            <i class="fa fa-repeat"></i> {{trans('labels.backend.common.back')}}
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
      </form>
      <!-- /.row -->
    </section>
@if (count($errors) > 0)
  <script>
    $(document).ready(function(){
        $('.span_cls_coefficient').html($('input[name=cls_coefficient]').val());
        if ($('.msn_batch').val() == '12' || $('.msn_batch').val() == '7') {
            $('.msn_id_class').next(".select2-container").hide();
        }
        var arraSelected = $('.msn_id_semester').find('option:selected').text().split('_');
        if(arraSelected[2] == '1'){
            $(".msn_batch option[value='7']").remove();
        } else {
            $(".msn_batch option[value='12']").remove();
        }
    });
  </script>
@endif
<script>
    $(document).ready(function(){
        if ($('.msn_batch').val() == '12' || $('.msn_batch').val() == '7') {
            $('.msn_id_class').next(".select2-container").hide();
        }
        var arraSelected = $('.msn_id_semester').find('option:selected').text().split('_');
        if(arraSelected[2] == '1'){
            $(".msn_batch option[value='7']").remove();
        } else {
            $(".msn_batch option[value='12']").remove();
        }
    });
</script>
<script>
    $(document).ready(function(){
        $('.btn-save-app').click(function(){
            $('.msn_id_semester,.msn_batch').removeAttr("disabled")
        });
        $('.msn_id_semester').change(function(){
            var arraSelected = $(this).find('option:selected').text().split('_');
            if(arraSelected[2] == '1'){
                $(".msn_batch option[value='7']").remove();
                $(".msn_batch option[value='12']").remove();
                $('.msn_batch').append('<option value="12">12</option>');
            } else {
                $(".msn_batch option[value='7']").remove();
                $(".msn_batch option[value='12']").remove();
                $('.msn_batch').append('<option value="7">7</option>');
            }
        });
        $('.msn_batch').change(function(){
            $('input[name=cls_name],input[name=cls_count_student]').val('');
            $('input[name=cls_coefficient]').val('0');
            if($('.msn_id_semester').val() != '') {
                if ($(this).val() == '1') {
                    $('.msn_id_class').next(".select2-container").show();
                    $('.row_class').css('display','none');
                    $('.cls_name').attr('type','hidden');
                }
                if ($(this).val() == '12' || $(this).val() == '7') {
                    $('.msn_id_class').next(".select2-container").hide();
                    $('.row_class').css('display','block');
                    $('.cls_name').attr('type','text');
                }
            }
        });
        $('input[name=cls_count_student]').keyup(function(){
            var countStudent = $(this).val();
            var result = '';
                if (countStudent != '' && countStudent > 0) {
                if (countStudent <= 50) {
                    result = '1.0';
                }
                else if ( 50 < countStudent && countStudent <= 65) {
                    result = '1.1';
                }
                else if ( 65 < countStudent && countStudent <= 80) {
                    result = '1.2';
                }
                else if ( 80 < countStudent && countStudent <= 100) {
                    result = '1.3';
                }
                else if ( 100 < countStudent && countStudent <= 120) {
                    result = '1.4';
                }
                else if ( 120 < countStudent && countStudent <= 140) {
                    result = '1.5';
                }
                else if ( 140 < countStudent && countStudent <= 160) {
                    result = '1.6';
                }
                else if ( 160 < countStudent && countStudent <= 180) {
                    result = '1.7';
                }
                else if(countStudent > 180 ) {
                    result = '1.8';
                }
            } else {
                result = '0'
            }
            $('.span_cls_coefficient').html(result);
            $('input[name=cls_coefficient]').val(result);
        });
    });
</script>
@stop

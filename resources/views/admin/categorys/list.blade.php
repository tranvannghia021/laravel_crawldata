@extends('admin.layouts.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header bg-info">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Danh mục</h1>
                </div>

            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
          @if (session('message'))
          <div class="custom_message {{session('class')}}" ><h5 class="text-message">{{session('message')}}</h5></div>
          @endif
            <div class="col-sm-6">
              
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Thêm danh mục</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" id="form-add-cate">
                        @csrf
                      <div class="card-body">
                        <div class="form-group">
                          <label for="category_name">Tên danh mục</label>
                          <input type="text" class="form-control" value="{{$name}}" name="category_name" id="category_name" placeholder="Tên danh mục ...">
                          <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                          <label for="">Danh mục cha</label>
                         <select name="category_id" class="form-control" id="parent_category">
                            <option {{$cate_id == 0 ? 'selected' : ''}} value="0">--Danh mục--</option>
                            @foreach ($categorys as $category)
                            <option {{$cate_id == $category->id ? 'selected' : ''}} value="{{$category->id}}" >
                              {{str_repeat('--', $category->level ).$category->name}}
                            </option>
                          @endforeach
                         </select>
                        </div>
                        
                      </div>
                      <!-- /.card-body -->
      
                      <div class="card-footer">
                        <button type="submit" id="btn_catgory" class="btn btn-primary">{{$button}}</button>
                      </div>
                    </form>
                  </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-12">
                      <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Danh sách danh mục</h3>
          
                          <div class="card-tools">
                            
                              <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
            
                                <div class="input-group-append">
                                  <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                  </button>
                                </div>
                              </div>
                           
                          </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                          <table class="table table-head-fixed text-nowrap">
                            <thead>
                              <tr>
                                <th>STT</th>
                                <th>Tên danh mục</th>
                                <th>Ngày tạo</th>
                                <th>#</th>
                                
                              </tr>
                            </thead>
                            <tbody id="show_table">
                              @if (count($categorys) ==0)
                                  <tr>
                                    <td colspan="4" class="text-center">Không có danh mục nào</td>
                                  </tr>
                              @else
                                  {!! \App\Helpers\Helper::category($categorys)!!}
                              @endif
                                
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>
                  </div>
            </div>
        </div>
 
    </section>
    <!-- /.content -->
@endsection

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Chặn thành viên</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('volunteer.active') }}" method="post">
          @csrf
        <div class="modal-body">
              <input type="hidden" name="id" id="userId">
              <div class="form-group">
                  <label for="exampleInputEmail1">Lý do</label>
                  <select name="" id="" class="form-control">
                      <option value="">Tài khoản có hành vi phá hoại</option>
                      <option value="">Tài khoản có ý thức kỉ luật kém</option>
                      <option value="">Tài khoản không còn tồn tại</option>
                      <option value="">Ảnh đại diện không hợp lệ</option>


                  </select>
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
              </div>
              <div class="row">

                <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Giờ</label>
                    <input type="number" class="form-control" aria-describedby="emailHelp" name="hours" min='0' max="24">
                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>
                  <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Ngày</label>
                      <input type="date" class="form-control" aria-describedby="emailHelp" name="day">
                      {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                  </div>

              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
          <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
        </form>
      </div>
    </div>
  </div>

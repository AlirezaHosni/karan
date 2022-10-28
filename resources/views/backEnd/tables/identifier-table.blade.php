<table class="table card-table table-striped table-vcenter text-nowrap mb-0 yajra-datatable">
    <thead>
    <tr>
        <th class="wd-lg-8p text-right"><span>ردیف</span></th>
        <th class="wd-lg-8p text-right"><span>تاریخ ایجاد</span></th>
        <th class="wd-lg-8p"><span>نام</span></th>
        <th class="wd-lg-8p"><span>کد ملی</span></th>
        <th class="wd-lg-8p"><span>شماره تلفن</span></th>
        <th class="wd-lg-8p"><span>استان</span></th>
        <th class="wd-lg-8p"><span>شهر</span></th>
        <th class="wd-lg-8p"><span>پایه</span></th>
        <th class="wd-lg-8p"><span>میزان خرید
(اشتراک – پک –
آزمون)</span></th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <th>{{ $user->id }}</th>
            <th>{{ jalaliDate($user->created_at, "%Y / %m / %d") }}</th>
            <th>{{ $user->fullName }}</th>
            <th>{{ $user->national_code }}</th>
            <th>{{ $user->phoneNumber }}</th>
            <th>{{ $user->userMeta->province }}</th>
            <th>{{ $user->userMeta->city }}</th>
            <th>{{ empty($user->userMeta->grade) ? '' : $user->userMeta->grade->title }}</th>
            <th>0</th>
        </tr>
    @endforeach
    <tr>
        <td>کل</td>
        <td id="total-price">۰ تومان</td>
    </tr>
    </tbody>
</table>

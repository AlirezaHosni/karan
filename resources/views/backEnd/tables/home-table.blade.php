<table class="table card-table table-striped table-vcenter text-nowrap mb-0 yajra-datatable">
    <thead>
    <tr>
        <th class="wd-lg-8p text-right"><span>ردیف</span></th>
        <th class="wd-lg-8p text-right"><span>تاریخ ایجاد</span></th>
        <th class="wd-lg-8p"><span>نام</span></th>
        <th class="wd-lg-8p"><span>معرف</span></th>
        <th class="wd-lg-8p"><span>کد ملی</span></th>
        <th class="wd-lg-8p"><span>شماره تلفن</span></th>
        <th class="wd-lg-8p"><span>شماره تلفن والدین</span></th>
        <th class="wd-lg-8p"><span>استان</span></th>
        <th class="wd-lg-8p"><span>شهر</span></th>
        <th class="wd-lg-8p"><span>وضعیت</span></th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <th>{{ $user->id }}</th>
            <th>{{ jalaliDate($user->created_at, "%Y / %m / %d") }}</th>
            <th>{{ $user->fullName }}</th>
            <th>{{ empty($user->userMeta->identifier) ? '' : $user->userMeta->identifier->fullName }}</th>
            <th>{{ $user->national_code }}</th>
            <th>{{ $user->phoneNumber }}</th>
            <th>{{ $user->userMeta->parent_phoneNumber }}</th>
            <th>{{ $user->userMeta->province }}</th>
            <th>{{ $user->userMeta->city }}</th>
            <th>{{ $user->gender == 0 ? 'غیر فعال' : 'فعال' }}</th>
        </tr>
    @endforeach
    </tbody>
</table>

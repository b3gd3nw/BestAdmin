<div class="modal-body">
    <form id="form{{ $member['id'] }}" method="POST" action="{{ route('member.update', $member['id'] )}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="firstname{{ $member['id'] }}">First Name</label>
            <input name="firstname" type="text" class="form-control" id="firstname{{ $member['id'] }}" value="{{ $member['firstname'] }}">
        </div>
        <div class="form-group">
            <label for="lastname{{ $member['id'] }}">Last Name</label>
            <input name="lastname" type="text" class="form-control" id="lastname{{ $member['id'] }}" value="{{ $member['lastname'] }}">
        </div>
        <div class="form-group">
            <label for="birthdate{{ $member['id'] }}">Birth Date</label>
            <input readonly="readonly" name="birthdate" type="text" class="form-control" id="birthdate{{ $member['id'] }}" value="{{ $member['birthdate'] }}">
        </div>
        <div class="form-group">
            <label for="reportsubject{{ $member['id'] }}">Report Subject</label>
            <input name="reportsubject" type="text" class="form-control" id="reportsubject{{ $member['id'] }}" value="{{ $member['reportsubject'] }}">
        </div>
        <div class="form-group">
            <label for="countryId{{ $member['id'] }}">Counrty</label>
            <select name="countryId" class="form-control" id="countryId{{ $member['id'] }}" required>
                @foreach($countries as $country)
                    <option value="{{ $country['id'] }}" @if ($country['id'] == $member['countryId']) selected
                            @endif>{{ $country['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="phone{{ $member['id']}}">Phone</label>
            <input data-inputmask="'mask': '+9(999) 999-9999'" name="phone" type="text" class="form-control phone" id="phone{{ $member['id']}}" value="{{ $member['phone'] }}">
        </div>
        <div class="form-group">
            <label for="{{ $member['id']}}">Email address</label>
            <input name="email" type="email" class="form-control" id="email{{ $member['id']}}" value="{{ $member['email'] }}">
        </div>
        <div class="form-group">
            <label for="company{{ $member['id']}}">Company</label>
            <input type="text" class="form-control" id="copmpany{{ $member['id']}}" value="{{ $member['company'] }}" name="company">
        </div>
        <div class="form-group">
            <label for="position{{ $member['id']}}">Position</label>
            <input type="text" class="form-control" id="position{{ $member['id']}}" value="{{ $member['position'] }}" name="position">
        </div>
        <div class="form-group">
            <label for="aboutme{{ $member['id']}}">About Me</label>
            <input type="text" class="form-control" id="aboutme{{ $member['id']}}" value="{{ $member['company'] }}" name="aboutme">
        </div>
        <div class="form-group group">
            <label for="photo{{ $member['id']}}">Photo</label>
            <div class="input_group">
                <div class="form-control input-wrapper">
                    <input type="file" class="photo-input" id="photo{{ $member['id']}}" name="photo">
                    <button data-path="{{ route('getphoto',$member['id']) }}" type="button" id="{{ $member['id']}}" class="clear-btn btn btn-outline-danger">x</button>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="image">
                        @if ( $member['photo'] !== null )
                            <img class="user_photo_prev img-thumbnail"
                                 src="/storage/{{ $member['photo'] }}"
                                 alt="user_photo">
                        @else
                            <img class="user_photo_prev img-thumbnail"
                                 src="https://randomuser.me/api/portraits/lego/6.jpg"
                                 alt="user_photo">
                        @endif
                    </div>
                </div>
                <div class="col-9">
                    <div class="button">
                        <button data-path="{{ route('delphoto',$member['id']) }}" type="button" id="delete_photo{{ $member['id']}}" class="btn btn-danger delete_photo">Delete photo</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="error" id="photo-size-error"></div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary {{ $member['id']}} submit">Save changes</button>
    </form>
</div>

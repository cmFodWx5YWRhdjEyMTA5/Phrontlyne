
			<div class="form-group @if($errors->has('name')) has-error has-feedback @endif">
				<label for="name">Customer Name</label>
				<input type="text" class="form-control" name="name" placeholder="E.g. Jason Kerr" value="{{ old('name') }}">
				@if ($errors->has('name'))
					<p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
					{{ $errors->first('name') }}
					</p>
				@endif
			</div>
			<div class="form-group @if($errors->has('phonenumber')) has-error has-feedback @endif">
				<label for="phonenumber"> Phone number</label>
				<input type="text" class="form-control" name="phonenumber" placeholder="E.g. 0541448708" value="{{ old('phonenumber') }}">
				@if ($errors->has('phonenumber'))
					<p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
					{{ $errors->first('phonenumber') }}
					</p>
				@endif
			</div>
			<div class="form-group @if($errors->has('title')) has-error has-feedback @endif">
				<label for="title">Event</label>
				<input type="text" class="form-control" name="title" placeholder="E.g. Meeting with CEO Kicap Tawar Hebey" value="{{ old('title') }}">
				@if ($errors->has('title'))
					<p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
					{{ $errors->first('title') }}
					</p>
				@endif
			</div>
			<div class="form-group @if($errors->has('time')) has-error @endif">
				<label for="time">Time</label>
				<div class="input-group">
					<input type="text" class="form-control" name="time" id="time" placeholder="Select your time" value="{{ old('time') }}">
					<span class="input-group-addon">
						<span class="fa fa-calendar"></span>
                    </span>
				</div>
				@if ($errors->has('time'))
					<p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
					{{ $errors->first('time') }}
					</p>
				@endif
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		
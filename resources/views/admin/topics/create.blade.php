@extends('layouts.admin') @section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">{{ $pageTitle }}</h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						<li><a data-action="close"></a></li>
					</ul>
				</div>
			</div>

			<div class="panel-body">
				<p class="content-group-lg">@include('errors._admin_form_errors')</p>
				<div class="tabbable">
					<!-- Form horizontal -->
					{!! Form::open(array('url' => 'admin/topics', 'files' => true,
					'class' => 'form-horizontal')) !!}
					<ul class="nav nav-tabs nav-tabs-bottom bottom-divided">
						<li class="active"><a href="#bottom-divided-tab1"
							data-toggle="tab">Content</a></li>
						<li><a href="#bottom-divided-tab2" data-toggle="tab">SEO</a></li>
						<li><a href="#bottom-divided-tab3" data-toggle="tab">Author</a></li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane active" id="bottom-divided-tab1">

							<fieldset class="content-group">
								<div class="form-group">
									<label class="control-label col-lg-2">Level</label>
									<div class="col-lg-10">
										<select name="level_id" class="form-control">
											<option value="1" @if(old('level_id') == 1) selected @endif>Bachelore</option>
											<option value="2" @if(old('level_id') == 2) selected @endif>Master</option>
											<option value="3" @if(old('level_id') == 3) selected @endif>Specialization</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Title <span
										class="text-danger">*</span></label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="title"
											value="{{ old('title') }}" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Summary <span
										class="text-danger">*</span></label>
									<div class="col-lg-10">
										<textarea name="summary" id="summary" rows="15" cols="80">
											{{ old('summary') }}
											</textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Note Title <span
										class="text-danger">*</span></label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="note_title"
											value="{{ old('note_title') }}" />
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-lg-2">Description <span
										class="text-danger">*</span></label>
									<div class="col-lg-10">
										<textarea name="description" id="editor1" rows="15" cols="80">
											{{ old('description') }}
											</textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-2 control-label text-semibold">File
										upload:</label>
									<div class="col-lg-10">
										<input type="file" class="file-input" name="file">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Mark to publish <span
										class="text-danger">*</span></label>
									<div class="col-lg-1">
										<input type="checkbox" class="form-control" name="active"
											@if(old('active')) checked @endif />
									</div>
								</div>
								<script>
										CKEDITOR.replace( 'editor1');
										CKEDITOR.replace( 'summary');
									</script>
							</fieldset>
						</div>

						<div class="tab-pane" id="bottom-divided-tab2">
							<fieldset class="content-group">
								<div class="form-group">
									<label class="control-label col-lg-2">H1 title</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="h1"
											value="{{ old('h1') }}" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Meta title</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="meta_title"
											value="{{ old('meta_title') }}" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Meta keywords</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="meta_keywords"
											value="{{ old('meta_keywords') }}" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Meta description</label>
									<div class="col-lg-10">
										<input type="text" class="form-control"
											name="meta_description" value="{{ old('meta_description') }}" />
									</div>
								</div>
							</fieldset>
						</div>

						<div class="tab-pane" id="bottom-divided-tab3">
							<fieldset class="content-group">
								<div class="form-group">
									<label class="control-label col-lg-2">Name</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="author_name"
											value="{{ old('author_name') }}" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Location</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="author_location"
											value="{{ old('author_location') }}" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Office</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="author_office"
											value="{{ old('author_office') }}" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Designation</label>
									<div class="col-lg-10">
										<input type="text" class="form-control"
											name="author_designation"
											value="{{ old('author_designation') }}" />
									</div>
								</div>
							</fieldset>
						</div>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">
							Post a topic <i class="icon-arrow-right14 position-right"></i>
						</button>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /tabs with bottom line -->
@endsection



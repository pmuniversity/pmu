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
					{!! Form::open(array('url' => 'admin/articles', 'files' => true,
					'class' => 'form-horizontal')) !!}
					<ul class="nav nav-tabs nav-tabs-bottom bottom-divided">
						<li class="active"><a href="#bottom-divided-tab1"
							data-toggle="tab">Content</a></li>
						<li><a href="#bottom-divided-tab2" data-toggle="tab">Author</a></li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane active" id="bottom-divided-tab1">

							<fieldset class="content-group">
								<input type="hidden" value="{{ $topicId }}" name="topic_id" />
								<div class="form-group">
									<label class="control-label col-lg-2">Article type</label>
									<div class="col-lg-10">
										<select name="type_title" class="form-control">
											<option value="top-10">Top 10</option>
											<option value="books">Books</option>
											<option value="videos">Videos</option>
											<option value="interviews">Intervies</option>
											<option value="notes">Notes</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Source URL <span
										class="text-danger">*</span></label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="source_url"
											value="{{ old('source_url') }}" />
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
									<label class="control-label col-lg-2">Textarea <span
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
										<input type="file" class="file-input" name="file_path">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-2">Youtube URL <span
										class="text-danger">*</span></label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="video_url"
											value="{{ old('video_url') }}" />
									</div>
								</div>
								<script>
										CKEDITOR.replace( 'editor1');
									</script>
							</fieldset>
						</div>
						<div class="tab-pane" id="bottom-divided-tab2">
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
							Post an article <i class="icon-arrow-right14 position-right"></i>
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



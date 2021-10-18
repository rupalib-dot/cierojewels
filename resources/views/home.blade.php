@extends('layouts.app')
@section('content')
<!-- Start Middle Part -->
    <div class="product-category">
        <div class="container">
            @include('common.breadcumb')


        <div id="user-profile-2" class="user-profile">
        <div class="tabbable">
           

            <div class="tab-content no-border padding-24 profile01">
                <div id="home" class="tab-pane in active">
                    <div class="row">
                       
					   
					   
					<div class="container">
						<table>
						<tr>
						<td>
						<section>
						<label for="fileToUpload">
						<i class="fa fa-camera"></i>
						<input type="file" id="fileToUpload" style="visibility:hidden;" accept=".png,.jpg,jpeg,.PNG,.JPEG" name="fileToUpload" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
						</label>
						<img src="https://i.ibb.co/yNGW4gg/avatar.png" id="blah" alt="Avatar">
						</section>
						<h4 class="jon01">{{Auth::user()->name}}</h4>        
						</td>
						<td>
						<ul>
						<li><b>Username</b> <input type="text" name="fname" id="fname" maxlength="100" value="{{Auth::user()->name}}" required /> <i class="fa fa-edit" id="edit1" onclick="document.getElementById('fname').style.pointerEvents='auto';document.getElementById('fname').focus();this.style.display='none'; document.getElementById('check1').style.display='inline-block';"></i> <i class="fa fa-check" style="display:none;" id="check1" onclick="document.getElementById('edit1').style.display='inline-block';this.style.display='none';document.getElementById('fname').style.pointerEvents='none';"></i></li>
						<li><b>Email</b> <input type="email" name="email" id="email" maxlength="150" value="{{Auth::user()->email}}" required /></li>
						<li><b>Mobile No.</b> <input type="tel" name="mobile" id="mobile" maxlength="10" value="{{Auth::user()->phone}}" required /> <i class="fa fa-edit" id="edit2" onclick="document.getElementById('mobile').style.pointerEvents='auto';document.getElementById('mobile').focus();this.style.display='none'; document.getElementById('check2').style.display='inline-block';"></i> <i class="fa fa-check" style="display:none;" id="check2" onclick="document.getElementById('edit2').style.display='inline-block';document.getElementById('mobile').style.pointerEvents='none';this.style.display='none';"></i></li>

						</ul>
						</td>
						</tr>

						</table>
				</div>  
					   
					   
					   
					   
					   
					   
                    </div><!-- /.row -->

                    <div class="space-20"></div>

                </div><!-- /#home -->
				
				
				
				
				
               
			   
            </div>
        </div>
    </div>

            
        </div>



</div>
@endsection

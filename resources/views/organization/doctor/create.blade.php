 <div class="row">
<form class="form-horizontal" method="POST" action="{{ route('dr.save') }}">
                        {{ csrf_field() }}
    <div class="row">
        <div class="input-field col s6">
          <input  id="first_name" name="name" type="text" class="validate">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" name="last_name" type="text" class="validate">
          <label for="last_name">Last Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="email" name="email" type="email" class="validate">
          <label for="email">Email</label>
        </div>
   
        <div class="input-field col s6">
          <input id="password" name="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
      </div>
      <button class="btn waves-effect waves-light" type="submit" >Submit
        <i class="material-icons right">send</i>
    </button>
    </form>
</div>
        
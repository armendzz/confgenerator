@extends('layouts/app')

<style>
    .tags-input-wrapper {
  background: #f9f9f9;
  padding: 10px;
  border-radius: 4px;
  max-width: 400px;
  border: 1px solid #ccc
}

.tags-input-wrapper input {
  border: none;
  background: transparent;
  outline: none;
  width: 150px;
}

.tags-input-wrapper .tag {
  display: inline-block;
  background-color: #009432;
  color: white;
  border-radius: 40px;
  padding: 0px 3px 0px 7px;
  margin-right: 5px;
  margin-bottom: 5px;
}

.tags-input-wrapper .tag a {
  margin: 0 7px 3px;
  display: inline-block;
  cursor: pointer;
}
</style>
@section('css')
<link rel="stylesheet" href="/css/style.css">

@endsection
@section('content')

<div class="card mt-2 mb-5">
    <div class="card-header">UnrealIrcD Config</div>
    <div class="card-body">

        <form action="/unrealgen" method="POST">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-sm-7 col-form-label border-bottom">Network Name:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="name" placeholder="e.g. irc.name.com" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-7 col-form-label border-bottom">Network Description:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="description" placeholder="e.g. Chat Network!" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="numericident" class="col-sm-7 col-form-label border-bottom">Numeric Ident - Must be between 1 and 255 & be unique from other shells connected to the network:</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="numericident" maxlength="3" name="numericident" pattern="[A-Za-z]{3}" placeholder="i.e. 001, 002" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="ssl" class="col-sm-7 col-form-label border-bottom">Would you like to enable SSL (Secure Socket Layer)?: </label>
                <div class="col-sm-5">
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="ssl" id="ssl" value="false" checked>
                        <label class="form-check-label" for="no">
                          No
                        </label>
                      </div>
                      <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="ssl" id="ssl" value="true">
                        <label class="form-check-label" for="yes">
                          Yes
                        </label>
                      </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="maxclient" class="col-sm-7 col-form-label border-bottom">Max Clients Allowed to Connect:</label>
                <div class="col-sm-5">
                    <select class="form-control" name="maxclient" id="maxclient">
                    <option value="200">200</option>
                    <option value="500">500</option>
                    <option value="700">700</option>
                    <option value="1000">1000</option>
                    <option value="1200">1200</option>
                    <option value="1500">1500</option>
                    <option value="2000">2000</option>
                </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="ipclient" class="col-sm-7 col-form-label border-bottom">Max Client from same IP: </label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" name="ipclient" placeholder="e.g. 3" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="networkowner" class="col-sm-7 col-form-label border-bottom">Network Owner: </label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="networkowner" placeholder="e.g. John" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="opernick" class="col-sm-7 col-form-label border-bottom">Oper Nickname: </label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="opernick" placeholder="i.e. The name used to oper up with" required>
                </div>
            </div>
           
                <div class="form-group row">
                    <label for="passtype" class="col-sm-7 col-form-label border-bottom">Please Select Password Type: </label>
                    <div class="col-sm-5" id="switchb">
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="passtype" id="encrypted" value="false" onclick="change(this)" >
                            <label class="form-check-label" for="no">
                                Encrypted
                            </label>
                        
                            <input class="form-check-input ml-3" type="radio" name="passtype" id="plaintext" value="true" onclick="change(this)">
                            <label class="form-check-label" for="yes">
                            PlainText
                            </label>
                        </div>
                    </div>
                </div>
                <div  class="d-none" id="operpassen">
                <div class="form-group row">
                    <label for="operpassen" class="col-sm-7 col-form-label border-bottom">Encrypted Oper Password (To find out how to encrypt a password see <strong> <a href="#" data-toggle="modal" data-target="#exampleModal">HERE</a></strong>): </label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="operpassen" id="operpassenn" placeholder="Enter Oper Password" required>
                    </div>
                </div>
            </div>
                <div class="form-group row d-none" id="operpasspl">
                    <label for="operpasspl" class="col-sm-7 col-form-label border-bottom">Enter PlainText Oper Pass </label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="operpasspl" id="operpassepll" placeholder="Enter Oper Password" required>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="operwhois" class="col-sm-7 col-form-label border-bottom">Oper Whois Line <span style="font-size: 85%;">(This shows up when someone preforms a whois on you if you are opered up)</span> :</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="operwhois" placeholder="i.e. Netowrk Administrator" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="opervhost" class="col-sm-7 col-form-label border-bottom">Oper vHost Line :</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="opervhost" placeholder="i.e. staff.mynetwork.org" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bindip" class="col-sm-7 col-form-label border-bottom">Enter the IP Address for the Shell the IRCd is being setup on:</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="bindip" placeholder="e.g. 127.0.0.1" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ports" class="col-sm-7 col-form-label border-bottom">Enter PORT for the IRCd <span>Default port is 6667</span> :</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="ports[]" placeholder="e.g. 6667" required>
                        <div id="addports"></div>
                        <div id="moresslp"></div>
                        <div id="moreserverp"></div>
                        <div id="moresslserverp"></div>
                        
                        <button type="button" class="btn btn-success mt-1 btn-sm" onclick="addmoreports()">+ Port</button>
                        <button type="button" class="btn btn-success mt-1 btn-sm" onclick="moresslp()">+ ssl Port</button>
                        <button type="button" class="btn btn-success mt-1 btn-sm" onclick="moreserverp()">+ server Port</button>
                        <button type="button" class="btn btn-success mt-1 btn-sm" onclick="moresslserverp()">+ ssl server Port</button>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label for="diepass" class="col-sm-7 col-form-label border-bottom">Password to "die" the Server (shut the server down) -<span style="font-size: 85%;"> This does not need to be encrypted</span>:</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="diepass" placeholder="Password" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="restartpass" class="col-sm-7 col-form-label border-bottom">Password to "restart" the Server - <span style="font-size: 85%;">This does not need to be encrypted</span>:</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="restartpass" placeholder="Password" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="helpchannel" class="col-sm-7 col-form-label border-bottom">Help Channel:</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="helpchannel" placeholder="e.g. #services or #help or #chat" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cloakkey1" class="col-sm-7 col-form-label border-bottom">Cloak key #1: (For more information on cloak keys see <strong> <a href="#" data-toggle="modal" data-target="#cloakModal">HERE</a></strong>): </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="cloakkey1" placeholder="Enter cloak Key #1" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cloakkey2" class="col-sm-7 col-form-label border-bottom">Cloak key #1: (For more information on cloak keys see <strong> <a href="#" data-toggle="modal" data-target="#cloakModal">HERE</a></strong>): </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="cloakkey2" placeholder="Enter cloak Key #2" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cloakkey3" class="col-sm-7 col-form-label border-bottom">Cloak key #1: (For more information on cloak keys see <strong> <a href="#" data-toggle="modal" data-target="#cloakModal">HERE</a></strong>): </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="cloakkey3" placeholder="Enter cloak Key #3" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="operchannel" class="col-sm-7 col-form-label border-bottom">Oper Chan - Channel that ircops will join when they oper up:</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="operchannel" placeholder="e.g. #admins or #opers or #ircops" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="klineadress" class="col-sm-7 col-form-label border-bottom">Set Kline E-mail Adress:</label>
                    <div class="col-sm-5">
                        <input type="e-mail" class="form-control" name="klineadress" placeholder="e.g. opers@mynetwork.com" required>
                    </div>
                </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary">Generate</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">How to encrypt a password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> To encrypt a password, type <strong>/mkpasswd argon2</strong> into the status window of a network you are
                    an ircop on.</p> For example <strong>/mkpasswd argon2 yourpassword</strong> Or  <strong> On *NIX shell: ./unrealircd mkpasswd argon2 yourpassword</strong> would return <p> **
                    Authentication phrase (method=argon2, para=yourpassword) is: <span style="font-style: italic">
                        $8rvIvg3C$uL/QGEFj2p79Tv1GnruvEUnmDNE=. </span> </p>
                <p> The section of that to copy and paste into the password box would be
                    $8rvIvg3C$uL/QGEFj2p79Tv1GnruvEUnmDNE=. </p>
                <hr>
                <p> Note: To use sha1 you must change the following option to "Yes" when compiling your IRCd</p>

                <p> <strong> Do you want to support SSL (Secure Socket Layer) connections?</p>
                <p> [No] -> Yes </strong> </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

  <div class="modal fade" id="cloakModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cloak keys</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>You need to use a string with random lowercase (a-z), uppercase (A-Z) and digit characters. The
                    string should be 5-100 characters long (10-20 is just fine)
                </p>
                <hr>
                <p> So for example:</p>
                <ul><strong>
                        <li>Key 1: uvEUnmEFj2p79Tv1Gnr</li>
                        <li>Key 2: GnruvEUnmEFj2p79Tv1</li>
                        <li>Key 3: ruvEUnmEFj2p7uvEUnm</li>
                    </strong>
                </ul>
                <hr>
                <p>These cloak keys must be the same on all servers on the networks or else bans won't work correctly.
                </p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    var plain = document.getElementById("operpassen")
    var encrypted = document.getElementById("operpasspl")
    var inputplain = document.getElementById("operpassenn")
    var inputencrypted = document.getElementById("operpassepll")
    function change(radio) { 
        if (radio.checked && radio.id === "plaintext") {
            encrypted.classList.remove('d-none')
            plain.classList.add('d-none')
            inputplain.removeAttribute('required')
            inputencrypted.setAttribute('required', '')
        } else {
            plain.classList.remove('d-none')
            encrypted.classList.add('d-none')
            inputencrypted.removeAttribute('required')
            inputplain.setAttribute('required', '')
        }
    }
</script>


@endsection

@section('js')


<script>
    $('#pass').on('shown.bs.modal', function () {
$('#pass').trigger('focus')
})
</script>


<script>
    function addmoreports() {
        var dummy = '<input type="text" class="form-control mt-1" name="ports[]" placeholder="e.g. 6667" required>\r\n';
        document.getElementById('addports').innerHTML += dummy;  
    }
</script>
<script>
    function moresslp() {
        var dummy = '<input type="text" class="form-control mt-1" name="sslports[]" placeholder="ADD SSL PORTS HERE - default is 6697" required>\r\n';
        document.getElementById('moresslp').innerHTML += dummy;  
    }
</script>
<script>
    function moreserverp() {
        var dummy = '<input type="text" class="form-control mt-1" name="serverports[]" placeholder="ADD SERVER PORTS HERE" required>\r\n';
        document.getElementById('moreserverp').innerHTML += dummy;  
    }
</script>
<script>
    function moresslserverp() {
        var dummy = '<input type="text" class="form-control mt-1" name="sslserverports[]" placeholder="ADD SSL SERVER PORTS HERE" required>\r\n';
        document.getElementById('moresslserverp').innerHTML += dummy;  
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
        var $regexname=/^[0-9][0-9][0-9]$/;
        var input = $('#numericident');
        $('#numericident').on('keypress keydown keyup',function(){
                 if ($(this).val().match($regexname)) {
                    $('#numericident').css('border-color',' #5cb85c');
                    $('#numericident').css('box-shadow','inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 4px #5cb85c');
                 }
               else{
                    // else, do not display message
                    $('#numericident').css('border-color',' #d9534f');
                    $('#numericident').css('box-shadow','inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 4px #d9534f');
                   }
             });
    });
</script>
@endsection
@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="/css/prism.css">

@endsection

@section('content')
    <div class="col-md-12">
<div class="card mt-2">
    <div class="card-header">UnrealIrcD Config</div>
    <div class="card-body"><pre class="line-numbers language-unrealscript" id="pre"><code class="language-unrealscript">#######################################################
        ##   _____            ____``			             ##
        ##  | ____|__ _  __ _|  _ \ _ __ ___  _ __           ##
        ##  |  _| / _` |/ _` | | | | '__/ _ \| '_ \          ##
        ##  | |__| (_| | (_| | |_| | | | (_) | |_) |         ##
        ##  |_____\__, |\__, |____/|_|  \___/| .__/          ##
        ##        |___/ |___/   1.8.4        |_|             ##
        ##                                                   ##
        ## eggdrop.conf by DeviL			                 ##
        ## irc.sisrv.net - support@sisrv.net                 ##
        ##						                             ##
        ## Build on 22.03.2020                               ##
        #######################################################
        
        ### Core Settings ###
        set admin "sisrv"
        set nick "MyBot"
        set altnick "MyBot1"
        set realname "irc.sisrv.net bot"
        set username "SiSrv"
        set net-type "3"
        set init-server { putserv "mode MyBot +ix" }
        set servers {
          you.need.to.change.this:6667
          another.example.com:7000:password
          [2001:db8:618:5c0:263::]:6669:password
          ssl.example.net:+6697
        }
        
        ## What is your network?
        ##   0 = EFnet
        ##   1 = IRCnet
        ##   2 = Undernet
        ##   3 = DALnet
        ##   4 = +e/+I/max-modes 20 Hybrid
        ##   5 = Others. See eggdrop.conf for settings related to this.
        set net-type 0
        
        set timezone "GMT"
        set offset "0"
        set env(TZ) "$timezone $offset"
        set vhost4/listen-addr "shell.ip.here"
        
        ### Logfile Settings ###
        set max-logs 5
        set max-logsize 0
        set quick-logs 0
        logfile mcobxs * "logs/MyBot.log"
        logfile jkp #SiSrv "logs/#SiSrv.log"
        set log-time 1
        set keep-all-logs 1
        set logfile-suffix ""
        set switch-logfiles-at 300
        set quiet-save 0
        
        ### Console Settings ###
        set console "mkcobxs"
        
        ### File & Directory Settings ###
        set userfile "MyBot.user"
        set pidfile "pid.MyBot"
        set chanfile "MyBot.chan"
        set force-expire 0
        set share-greet 0
        set use-info 1
        set sort-users 0
        set help-path "help/"
        set text-path "text/"
        set temp-path "/tmp"
        set motd "text/motd"
        set telnet-banner "text/banner"
        set userfile-perm 0600
        set mod-path "modules/"
        
        ### BotNet Settings ###
        set botnet-nick "MyBot"
        listen 3456 all
        set remote-boots 0
        set shareunlinks 0-
        set protect-telnet 1
        set dcc-sanitycheck 1
        set ident-timeout 0
        set require-p 1
        set open-telnets 0
        set stealth-telnets 0
        set use-telnet-banner 0
        set connect-timeout 30
        set dcc-flood-thr 3
        set telnet-flood 5:60
        set paranoid-telnet-flood 1
        set resolve-timeout 15
        
        ### Channel Settings ###
        loadmodule channels
        set global-flood-chan 4:5
        set global-flood-deop 0:0
        set global-flood-kick 0:0
        set global-flood-join 4:05
        set global-flood-ctcp 2:02
        set global-flood-nick 5:20
        set global-aop-delay 0:00
        set global-idle-kick 0
        set global-chanmode "nt"
        set global-stopnethack-mode 0
        set global-revenge-mode 0
        set global-ban-time 0
        set global-exempt-time 60
        set global-invite-time 60
        
        set global-chanset {
            -autoop           -autovoice
            -bitch            -cycle
            +dontkickops      -dynamicbans
            +dynamicexempts   +dynamicinvites
            -enforcebans      -greet
            -inactive         +nodesynch
            -protectfriends   -protectops
            -revenge          -revengebot
            -secret           +seen
            +shared           -statuslog
            +userbans         +userexempts
            +userinvites      -protecthalfops
            -autohalfop
        }
        
        channel add #SiSrv {
        chanmode "+tn"
            idle-kick 0
            flood-chan 5:4
            flood-join 5:10
            flood-ctcp 3:60
            flood-deop 0:0
            flood-kick 0:0
        }
        channel set #SiSrv -enforcebans -dynamicbans -autoop -autovoice -protectops -protectfriends
        
        ### Advanced Settings ###
        set ignore-time 5
        set hourly-updates 00
        set owner "BotOwnerNick"
        set notify-newusers "3456"
        set default-flags "hp"
        set whois-fields "url birthday"
        set die-on-sighup 0
        set die-on-sigterm 1
        set nat-ip "shell.ip.here"
        unbind dcc n tcl *dcc:tcl
        unbind dcc n set *dcc:set
        set must-be-owner 1
        unbind dcc n simul *dcc:simul
        set max-dcc 50
        set enable-simul 1
        set allow-dk-cmds 1
        set dupwait-timeout 5
        
        ### Module Settings ###
        loadmodule dns
        loadmodule transfer
        loadmodule share
        loadmodule server
        loadmodule ctcp
        loadmodule irc
        loadmodule notes
        loadmodule console
        loadmodule blowfish
        checkmodule blowfish
        loadmodule uptime
        
        set keep-nick 1
        set strict-host 0
        set quiet-reject 1
        set lowercase-ctcp 0
        set answer-ctcp 3
        set flood-msg 5:5
        set flood-ctcp 3:60
        set never-give-up 1
        set strict-servernames 0
        set server-cycle-wait 60
        set server-timeout 60
        set servlimit 0
        set check-stoned 1
        set use-console-r 0
        set debug-output 0
        set serverror-quit 1
        set max-queue-msg 300
        set trigger-on-ignore 0
        set double-mode 0
        set double-server 0
        set double-help 0
        set optimize-kicks 1
        set stack-limit 4
        set ctcp-mode 0
        set bounce-bans 1
        set bounce-modes 0
        set max-bans 100
        set max-modes 30
        set kick-fun 0
        set ban-fun 0
        set learn-users 0
        set wait-split 600
        set wait-info 180
        set mode-buf-length 200
        bind msg - ident *msg:ident
        bind msg - addhost *msg:addhost
        set no-chanrec-info 0
        set bounce-exempts 0
        set bounce-invites 0
        set max-exempts 20
        set max-invites 20
        set prevent-mixing 1
        set max-dloads 3
        set dcc-block 1024
        set copy-to-tmp 1
        set xfer-timeout 30
        set share-compressed 1
        set max-notes 50
        set note-life 60
        set allow-fwd 0
        set notify-users 1
        set notify-onjoin 1
        set console-autosave 1
        set force-channel 0
        set info-party 0
        
        ### Script Settings ###
        source scripts/alltools.tcl
        source scripts/action.fix.tcl
        source scripts/cmd_resolve.tcl
        source scripts/compat.tcl
        
        set init-server {
        putquick "identify BotNick BotPass"
        putserv "oper BotNick BotOperPass"
        }
        
        
        # A few IRC networks (EFnet and Undernet) have added some simple checks to
        # prevent drones from connecting to the IRC network. While these checks are
        # fairly trivial, they will prevent your Eggdrop from automatically
        # connecting. In an effort to work-around these, we have developed a couple of
        # TCL scripts to automate the process.
        
        if {[info exists net-type]} {
          switch -- ${net-type} {
            "0" {
              # EFnet
              source scripts/quotepong.tcl
            }
            "2" {
              # Undernet
              source scripts/quotepass.tcl
            }
          }
        }</code></pre>
     {{--    <pre data-src="/foobar.js" class="line-numbers language-unrealscript"></pre> --}}
    </div>
</div>
</div>
@endsection

@section('js')

<script src="/js/prism.js"></script>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>

<script>
    (function () {
	if (typeof self === 'undefined' || !self.Prism || !self.document || !document.querySelector) {
		return;
	}

	/**
	 * @param {Element} [container=document]
	 */
	self.Prism.fileHighlight = function(container) {
		container = container || document;

		var Extensions = {
			'js': 'javascript',
			'py': 'python',
			'rb': 'ruby',
			'ps1': 'powershell',
			'psm1': 'powershell',
			'sh': 'bash',
			'bat': 'batch',
			'h': 'c',
			'tex': 'latex'
		};

		Array.prototype.slice.call(container.querySelectorAll('pre[data-src]')).forEach(function (pre) {
			// ignore if already loaded
			if (pre.hasAttribute('data-src-loaded')) {
				return;
			}

			// load current
			var src = pre.getAttribute('data-src');

			var language, parent = pre;
			var lang = /\blang(?:uage)?-([\w-]+)\b/i;
			while (parent && !lang.test(parent.className)) {
				parent = parent.parentNode;
			}

			if (parent) {
				language = (pre.className.match(lang) || [, ''])[1];
			}

			if (!language) {
				var extension = (src.match(/\.(\w+)$/) || [, ''])[1];
				language = Extensions[extension] || extension;
			}

			var code = document.createElement('code');
			code.className = 'language-' + language;

			pre.textContent = '';

			code.textContent = 'Loading…';

			pre.appendChild(code);

			var xhr = new XMLHttpRequest();

			xhr.open('GET', src, true);

			xhr.onreadystatechange = function () {
				if (xhr.readyState == 4) {

					if (xhr.status < 400 && xhr.responseText) {
						code.textContent = xhr.responseText;

						Prism.highlightElement(code);
						// mark as loaded
						pre.setAttribute('data-src-loaded', '');
					}
					else if (xhr.status >= 400) {
						code.textContent = '✖ Error ' + xhr.status + ' while fetching file: ' + xhr.statusText;
					}
					else {
						code.textContent = '✖ Error: File does not exist or is empty';
					}
				}
			};

			xhr.send(null);
		});
	};

	document.addEventListener('DOMContentLoaded', function () {
		// execute inside handler, for dropping Event as argument
		self.Prism.fileHighlight();
	});

})();
</script>
@endsection
@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="/css/prism.css">

@endsection

@section('content')
    <div class="col-md-12">
<div class="card mt-2">
    <div class="card-header">UnrealIrcD Config</div>
    <div class="card-body"><pre class="line-numbers language-unrealscript" id="pre"><code class="language-unrealscript">#######################################################
        ##                                                   ##
        ##   _____                 _ _____ _____ _____   _   ##
        ##  |  |  |___ ___ ___ ___| |     | __  |     |_| |  ##
        ##  |  |  |   |  _| -_| .'| |-   -|    -|   --| . |  ##
        ##  |_____|_|_|_| |___|__,|_|_____|__|__|_____|___|  ##
        ##                                         5.0.5     ##
        ## UnrealIRCd.conf by DeviL                          ##
        ## irc.sisrv.net - support@sisrv.net                 ##
        ##                                                   ##
        ## Build on 02.05.2020                               ##
        #######################################################
         
        /* See: https://www.unrealircd.org/docs/Modules
         * Now let's include some other files as well:
         */
         
        include "aliases/anope.conf";
        include "spamfilter.conf";
        include "badwords.conf";
        include "staff.conf";
        include "modules.default.conf";
        include "modules.optional.conf";
        include "operclass.default.conf";
         
         
        me {
            name {{ $request->name }};
            info "{{ $request->info }}";
            sid 001;
        };
        admin {
                "Server: SiSrv.net";
                "E-Mail: support@sisrv.net";
        };
         
        /* Clients and servers are put in class { } blocks, we define them here.
         * Class blocks consist of the following items:
         * - pingfreq: how often to ping a user / server (in seconds)
         * - connfreq: how often we try to connect to this server (in seconds)
         * - sendq: the maximum queue size for a connection
         * - recvq: maximum receive queue from a connection (flood control)
         */
         
        /* Client class with good defaults */
        class clients
        {
            pingfreq 300;
            maxclients 1000;
            sendq 999999;
            recvq 9999;
        };
         
        /* Special class for IRCOps with higher limits */
        class opers
        {
            pingfreq 600;
            maxclients 500;
            sendq 1M;
            recvq 8000;
        };
         
        /* Server class with good defaults */
        class servers
        {
            pingfreq 90;
            connfreq 25; /* try to connect every 25 seconds */
            maxclients 20; /* max servers */
            sendq 5M;
        };
         
        /* Allow everyone in, but only 5 connections per IP */
        allow {
            ip *@*;
            class clients;
            maxperip 5;  
        };
         
        /* Deny channel block */
         
        deny channel {
            channel "#*cc*";
            reason "CC channels are forbidden in this network!";
            redirect "#SiSrv";
            warn on;
        };
        deny channel {
            channel "#operhelp";
            reason "Our network help channel is #SiSrv our main channel";
            redirect "#Help";
        };
        deny channel {
            channel "#*sex*";
            reason "Sex channels are forbidden in this network!";
            warn on;
        };
         
        /* Oper blocks define your IRC Operators. */
         
        oper DeviL {
                mask *@*;
            password "$argon2id$v=19$m=8192,t=3,p=2$86M+flkuHHzLTua1d1AyNA$Wvr52Y+PS5XUeUvN9fFDKEhBREmTHbmgK0NUnnUL9As" { argon2; };
            class opers;
            operclass netadmin-with-override;
                maxlogins 5;
            swhois "is SiSrv staff";
            vhost staff.sisrv.net;
        };
         
         
        /* Blacklist Config. */
         
        blacklist dronebl {
                dns {
                        name dnsbl.dronebl.org;
                        type record;
                        reply { 2; 3; 5; 6; 7; 8l 9; 10; 13; 14; 15; 17; 255; };
                };
                action gzline;
                ban-time 1h;
                reason "An open proxy was detected on your IP: $ip - DroneBL";
        };
        blacklist efnetrbl {
                dns {
                        name rbl.efnetrbl.org;
                        type record;
                        reply { 1; 5; };
                };
                action gzline;
                ban-time 1h;
                reason "An open proxy was detected on your IP: $ip - EfNETrbl";
        };
        blacklist proxybl {
                dns {
                       name dnsbl.proxybl.org;
                       type record;
                       reply { 2; };
                };
                action gzline;
                ban-time 1h;
                reason "An open proxy was detected on your IP: $ip - ProxyBL";
        };
         
        /* Standard IRC port 6667 */
         
        listen {
            ip shell.ip.here;
                port 6667;
        };
        listen {
            ip shell.ip.here;
                port 6668;
        };
        listen {
            ip shell.ip.here;
                port 6669;
        };
        listen {
            ip shell.ip.here;
            port 8080;
            options { tls; serversonly; };
        };
         
        /* Standard IRC SSL/TLS port 6679 */
        listen {
            ip shell.ip.here;
            port 6697;
            options { ssl; };
        };
         
        /*
         * Link blocks allow you to link multiple servers together to form a network.
         * See https://www.unrealircd.org/docs/Tutorial:_Linking_servers
         */
         
        link services.sisrv.net
        {
            incoming {
                mask 127.0.0.1;
            };
         
            password "changemeplease";
         
            class servers;
        };
         
        link irc1.sisrv.net {
            incoming {
               mask *;
            }; 
            outgoing { 
            bind-ip *; 
            hostname  12.13.14.15;
            port 8080;
               options { ssl; };
          };
            /* We use the SPKI fingerprint of the other server for authentication.
             * Run './unrealircd spkifp' on the other side to get it.
             */
            password "GFpiziI2otejDwnrVTYFMqd/ehYPRJWOekTbfE/YgsY=" { spkifp; };
            hub *;
            class servers;
            verify-certificate yes;
        };
         
         
        /* U-lines give other servers (even) more power/commands. */
        ulines {
            services.sisrv.net;
            stats.sisrv.net;
        };
         
        /* Here you can add a password for the IRCOp-only /DIE and /RESTART commands. */
        drpass {
            restart "RestartBaby";
            die "DieBigMama";
        };
         
        tld {
            mask *@*;
            motd ircd.motd;
            rules ircd.rules;
            opermotd oper.motd;
        };
         
        /* The log block defines what should be logged and to what file. */
         
        /* This is a good default, it logs almost everything */
         
        log "ircd.log" {
            flags {
                oper;
                server-connects;
                kills;
                errors;
                sadmin-commands;
                chg-commands;
                oper-override;
                tkl;
                spamfilter;
            };
                maxsize 10M;
        };
         
        log users.log {
                flags {
                        connects;
                };
                maxsize 10M;
        };
         
        /* With deny dcc blocks you can ban filenames for DCC */
        deny dcc {
            filename "*sub7*";
            reason "Possible Sub7 Virus";
        };
         
        /* deny channel allows you to ban a channel (mask) entirely */
        deny channel {
            channel "*sex*";
            reason "sex* is illegal";
            class "clients";
        };
         
        /* Network configuration */
        set {
            network-name        "SiSrv";
            default-server          "irc.sisrv.net";
            services-server     "services.sisrv.net";
                sasl-server             "services.sisrv.net";
            stats-server        "stats.sisrv.net";
            help-channel        "#SiSrv";
            hiddenhost-prefix   "SiSrv";
            prefix-quit         "SiSrv.net";
         
            cloak-keys {
                 "LCdRdwzb88hPkMmnGF3cbOv0b";
                 "mFFQaKFSjSl267cmmElq2uHqx";
                 "wHmk7pJULg8OuhCLfp74MgQId";
            };
        };
         
        /* Server specific configuration */
         
        set {
            kline-address "support@sisrv.net";
            modes-on-connect "+icxvw";
                auto-join "#SiSrv";
                modes-on-join "+ntVCTGf [3j#i1,7m#M1,2n#N1,6t#b]:2";    
            modes-on-oper    "+WxwgIspq";
                restrict-usermodes "icvwx";
                snomask-on-oper "+cFfkejvGnNqsSo";
                who-limit 3;
                nick-length 15;
            oper-auto-join "#SiSrv,#Staff";
            options {
                hide-ulines;
                    flat-map;
                    allow-part-if-shunned;
                    fail-oper-warn;
                    show-opermotd;
            };
         
            maxchannelsperuser 10; /* maximum number of channels a user may /JOIN */
         
            /* The minimum time a user must be connected before being allowed to
             * use a QUIT message. This will hopefully help stop spam.
             */
            anti-spam-quit-message-time 10s;
                static-part "Leaving...";
                static-quit "SiSrv.net";
         
            /* Which /STATS to restrict to opers only. We suggest to leave it to * (ALL) */
            allow-user-stats "*";
         
                /* Unreal 5.0.x settings */
                check-target-nick-bans "yes";
                ping-cookie "yes";
                watch-away-notification "yes";
                hide-ban-reason "no";
               
            /* Anti flood protection */
            anti-flood {
                nick-flood 2:120;  
                connect-flood 3:45;
                away-flood 2:120;  
                        join-flood 3:60;
            };
         
            /* Settings for spam filter */
            spamfilter {
                ban-time 3h;
                ban-reason "Spamming is not allowed in this network!";
                virus-help-channel "#SiSrv";
                    except "#SiSrv,#Staff";
            };
        };
        /******************************************************
        * KiwiIRCD config :
        * Create your widget here: https://kiwiirc.com/login
         *****************************************************/
        except ban {
            mask 109.169.31.4;
        };
        except ban {
            mask 107.161.19.53;
        };
        except ban {
            mask 107.161.19.109;
        };
        webirc {
            mask 109.169.31.4;
            password "yourpasswd";
        };
        webirc {
            mask 107.161.19.53;
            password "yourpasswd";
        };
        webirc {
            mask 107.161.19.109;
            password "yourpasswd";
        };
        except throttle {
            mask 109.169.31.4;
        };
        except throttle {
            mask 107.161.19.53;
        };
        except throttle {
            mask 107.161.19.109;
        };
        /*************************************************************
        * Mibbit config :
        * Create your widget here: https://widgetmanager.mibbit.com/
         ************************************************************/
        webirc {
            mask 64.62.228.82;
            password "yourpasswd";
        };
        webirc {
            mask 207.192.75.252;
            password "yourpasswd";
        };
        webirc {
            mask 78.129.202.38;
            password "yourpasswd";
        };
        webirc {
            mask 109.169.29.95;
            password "yourpasswd";
        };
        except ban {
            mask 64.62.228.82;
        };
        except ban {
            mask 207.192.75.252;
        };
        except ban {
            mask 78.129.202.38;
        };
        except ban {
            mask 109.169.29.95;
        };
        except throttle {
            mask 64.62.228.82;
        };
        except throttle {
            mask 207.192.75.252;
        };
        except throttle {
            mask 78.129.202.38;
        };
        except throttle {
            mask 109.169.29.95;
        };
         
         
        /*
         * Unrealircd.conf by DeviL (support@sisrv.net).
         * For any help visit https://www.SiSrv.Net
         * or join #SiSrv @ irc.sisrv.net
        */</code></pre>
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
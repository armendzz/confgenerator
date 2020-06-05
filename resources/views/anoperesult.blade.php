@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="/css/prism.css">

@endsection

@section('content')
    <div class="col-md-12">
<div class="card mt-2">
    <div class="card-header">UnrealIrcD Config</div>
    <div class="card-body"><pre class="line-numbers language-unrealscript" id="pre">
        <code class="language-unrealscript">#################################################################################  
            ##      _                             ____                  _		           ##
            ##     / \   _ __   ___  _ __   ___  / ___|  ___ _ ____   _(_) ___ ___  ___    ##
            ##    / _ \ | '_ \ / _ \| '_ \ / _ \ \___ \ / _ \ '__\ \ / / |/ __/ _ \/ __|   ##
            ##   / ___ \| | | | (_) | |_) |  __/  ___) |  __/ |   \ V /| | (_|  __/\__ \   ##
            ##  /_/   \_\_| |_|\___/| .__/ \___| |____/ \___|_|    \_/ |_|\___\___||___/   ## 
            ##                      |_| 2.0.7					                           ##
            ##                                                                             ##
            ## services.conf by DeviL			                                           ##
            ## irc.sisrv.net - support@sisrv.net                                           ##
            ##						                                                       ##
            ## Build on 02.04.2020                                                         ##
            ################################################################################# 
            
            /*
             * [REQUIRED] IRCd Config
             */
            
            uplink
            {
            
                host = "127.0.0.1"
                ipv6 = no
                ssl = no
                port = 8080
                password = "link:password:here"
            }
            
            /*
             * [REQUIRED] Server Information
             *
             * This section contains information about the Services server.
             */
            serverinfo
            {
            
                name = "services.sisrv.net"
                description = "Services for SiSrv Network"
                #localhost = "nowhere."
                #id = "00A"
                pid = "data/services.pid"
                motd = "conf/services.motd"
            }
            
            /*
             * [REQUIRED] Protocol module
             *
             * This directive tells Anope which IRCd Protocol to speak when connecting.
             * You MUST modify this to match the IRCd you run.
             */
            module
            {
                name = "unreal4"
            }
            
            /*
             * [REQUIRED] Network Information
             *
             * This section contains information about the IRC network that Services will be
             * connecting to.
             */
            networkinfo
            {
                /*
                 * This is the name of the network that Services will be running on.
                 */
                networkname = "SiSrv"
                nicklen = 31
                userlen = 10
                hostlen = 64
                chanlen = 32
                modelistsize = 100
                vhost_chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789.-"
                allow_undotted_vhosts = false
                disallow_start_or_end = ".-"
            }
            
            /*
             * [REQUIRED] Services Options
             *
             * This section contains various options which determine how Services will operate.
             */
            options
            {
                /*
                 * On Linux/UNIX systems Anope can setuid and setgid to this user and group
                 * after starting up. This is useful if Anope has to bind to privileged ports
                 */
                #user = "anope"
                #group = "anope"
                casemap = "ascii"
                seed = 9866235
                    strictpasswords = yes
                    badpasslimit = 3
                    badpasstimeout = 1h
                    updatetimeout = 5m
                    expiretimeout = 30m
                readtimeout = 5s
                warningtimeout = 4h
                timeoutcheck = 3s
                hidestatso = yes
                ulineservers = "services.sisrv.net"
                retrywait = 60s
                hideprivilegedcommands = yes
                hideregisteredcommands = yes
                regexengine = "regex/pcre"
                languages = "ca_ES.UTF-8 de_DE.UTF-8 el_GR.UTF-8 es_ES.UTF-8 fr_FR.UTF-8 hu_HU.UTF-8 it_IT.UTF-8 nl_NL.UTF-8 pl_PL.UTF-8 pt_PT.UTF-8 ru_RU.UTF-8 tr_TR.UTF-8"
            
            }
            
            /*
             *
             * Includes botserv.example.conf, which is necessary for BotServ functionality.
             *
             * Remove this block to disable BotServ.
             */
            include
            {
                type = "file"
                name = "botserv.conf"
            }
            include
            {
                type = "file"
                name = "chanserv.conf"
            }
            include
            {
                type = "file"
                name = "global.conf"
            }
            include
            {
                type = "file"
                name = "hostserv.conf"
            }
            include
            {
                type = "file"
                name = "memoserv.conf"
            }
            include
            {
                type = "file"
                name = "nickserv.conf"
            }
            include
            {
                type = "file"
                name = "operserv.conf"
            }
            include
            {
                type = "file"
                name = "modules.conf"
            }
            
            /*
             * [RECOMMENDED] Logging Configuration
             *
            */
            /*
                 * What types of log messages should be logged by this block. There are nine general categories:
                 *
                 *  admin      - Execution of admin commands (OperServ, etc).
                 *  override   - A services operator using their powers to execute a command they couldn't normally.
                 *  commands   - Execution of general commands.
                 *  servers    - Server actions, linking, squitting, etc.
                 *  channels   - Actions in channels such as joins, parts, kicks, etc.
                 *  users      - User actions such as connecting, disconnecting, changing name, etc.
                 *  other      - All other messages without a category.
                 *  rawio      - Logs raw input and output from services
                 *  debug      - Debug messages (log files can become VERY large from this).
                 *
                 * These options determine what messages from the categories should be logged. Wildcards are accepted, and
                 * you can also negate values with a ~. For example, "~operserv/akill operserv/*" would log all operserv
                 * messages except for operserv/akill. Note that processing stops at the first matching option, which
                 * means "* ~operserv/*" would log everything because * matches everything.
                 *
                 * Valid admin, override, and command options are:
                 *    pesudo-serv/commandname (eg, operserv/akill, chanserv/set)
                 *
                 * Valid server options are:
                 *    connect, quit, sync, squit
                 *
                 * Valid channel options are:
                 *    create, destroy, join, part, kick, leave, mode
                 *
                 * Valid user options are:
                 *    connect, disconnect, quit, nick, ident, host, mode, maxusers, oper
                 *
                 * Rawio and debug are simple yes/no answers, there are no types for them.
                 *
                 * Note that modules may add their own values to these options.
                 */
            
            log
            {
                /*
                 * Target(s) to log to, which may be one of the following:
                 *   - a channel name
                 *   - a filename
                 *   - globops
                 */
                target = "stats.log"
                target = "stats.log #staff"
                #source = ""
                bot = "Global"
                logage = 7
                admin = "*"
                override = "chanserv/* nickserv/* memoserv/set botserv/* operserv/*"
                commands = "operserv/* chanserv/* nickserv/register nickserv/drop"
                servers = "*"
                users = "maxusers oper"
                other = "*"
                rawio = no
                debug = no
            }
            
            log
            {
                bot = "Global"
                target = "globops"
                channels = "kick create"
                target = "services.log #services"
                users = "connect disconnect ident host"
            }
            
            log
            {
                target = "globops"
                admin = "global/* operserv/mode operserv/kick operserv/akill operserv/s*line operserv/noop operserv/jupe operserv/oline operserv/set operserv/svsnick operserv/svsjoin operserv/svspart nickserv/getpass */drop"
                    servers = "squit"
                users = "oper"
                other = "expire/* bados akill/*"
            }
            
            /*
             * Oper Configuration (services)
             */
             
            
            opertype
            {
                name = "Helper"
                commands = "chanserv/access/list hostserv/*"
                privs = "memoserv/*"
            }
             
            opertype
            {
                name = "Services Operator"
                inherits = "Helper, Another Helper"
                commands = "chanserv/list chanserv/suspend chanserv/topic memoserv/staff nickserv/list nickserv/resetpass nickserv/suspend operserv/mode operserv/chankill operserv/akill operserv/session operserv/modinfo operserv/sqline operserv/oper operserv/kick operserv/ignore operserv/snline"
                privs = "chanserv/auspex chanserv/no-register-limit memoserv/* nickserv/auspex"
                modes = "+o"
            }
             
            opertype
            {
                name = "Services Administrator"
                inherits = "Services Operator"
                commands = "chanserv/access/list chanserv/getkey chanserv/saset/noexpire memoserv/sendall nickserv/saset/* nickserv/getemail operserv/news operserv/jupe operserv/svs operserv/stats global/*"
                privs = "*"
            }
             
            opertype
            {
                name = "Services Root"
                commands = "*"
                privs = "*"
            }
             
            /*
            * Oper Block
            */
            oper
            {
                name = "Admin"
                type = "Services Root"
                require_oper = yes
                host = "*@*"
            }
            
            /*
             * [OPTIONAL] Mail Config
             *
             * This section contains settings related to the use of e-mail from Services.
             * If the usemail directive is set to yes, unless specified otherwise, all other
             * directives are required.
             *
             * NOTE: Users can find the IP of the machine services is running on by examining
             * mail headers. If you do not want your IP known, you should set up a mail relay
             * to strip the relevant headers.
             */
            mail
            {
            
                usemail = yes
                sendmailpath = "/usr/sbin/sendmail -t"
                sendfrom = "services@sisrv.net"
                delay = 5m
                #dontquoteaddresses = yes
            
                /*
                 * The subject and message of emails sent to users when they register accounts.
                 */
                registration_subject = "Nickname registration for %n"
                registration_message = "Hi,
             
                            You have requested to register the nickname %n on %N.
                            Please type \" /msg NickServ CONFIRM %c \" to complete registration.
             
                            If you don't know why this mail was sent to you, please ignore it silently.
             
                            %N administrators."
            
                /*
                 * The subject and message of emails sent to users when they request a new password.
                 */
                reset_subject = "Reset password request for %n"
                reset_message = "Hi,
             
                        You have requested to have the password for %n reset.
                        To reset your password, type \" /msg NickServ CONFIRM %n %c \"
             
                        If you don't know why this mail was sent to you, please ignore it silently.
             
                        %N administrators."
            
                /*
                 * The subject and message of emails sent to users when they request a new email address.
                 */
                emailchange_subject = "Email confirmation"
                emailchange_message = "Hi,
             
                        You have requested to change your email address to %e.
                        Please type \" /msg NickServ CONFIRM %c \" to confirm this change.
             
                        If you don't know why this mail was sent to you, please ignore it silently.
             
                        %N administrators."
            
                /*
                 * The subject and message of emails sent to users when they receive a new memo.
                 */
                memo_subject = "New memo"
                memo_message = "Hi %n,
             
                        You've just received a new memo from %s. This is memo number %d.
             
                        Memo text:
             
                        %t"
            }
            
            
            /*
             * [REQUIRED] Database configuration.
             *
             * This section is used to configure databases used by Anope.
             * You should at least load one database method, otherwise any data you
             * have will not be stored!
             */
            
            #module
            {
                name = "db_old"
                hash = "plain"
            }
            
            /*
             * [RECOMMENDED] db_flatfile
             *
             * This is the default flatfile database format.
             */
            module
            {
                name = "db_flatfile"
                database = "anope.db"
                keepbackups = 3
                #nobackupokay = yes
                fork = no
            }
            
            /*
             * db_sql and db_sql_live
             *
             * db_sql module allows saving and loading databases using one of the SQL engines.
             * This module loads the databases once on startup, then incrementally updates
             * objects in the database as they are changed within Anope in real time. Changes
             * to the SQL tables not done by Anope will have no effect and will be overwritten.
             *
             * db_sql_live module allows saving and loading databases using one of the SQL engines.
             * This module reads and writes to SQL in real time. Changes to the SQL tables
             * will be immediately reflected into Anope. This module should not be loaded
             * in conjunction with db_sql.
             *
             */
            module
            {
                name = "db_sql"
                engine = "sqlite/main"
                prefix = "anope_db_"
                import = false
            }
            
            
            
            /*
             * [RECOMMENDED] Encryption modules.
             */
            
            #module { name = "enc_bcrypt" }
            module { name = "enc_sha256" }
            #module { name = "enc_md5" }
            #module { name = "enc_sha1" }
            
            /*
             * When using enc_none, passwords will be stored without encryption. This isn't secure
             * therefore it is not recommended.
             */
            module { name = "enc_none" }
            
            /*
             * enc_old is Anope's previous (broken) MD5 implementation used from 1.4.x to 1.7.16.
             * If your databases were made using that module, load it here to allow conversion to the primary
             * encryption method.
             */
            #module { name = "enc_old" }
            
            
            /* Extra (optional) modules. */
            include
            {
                type = "file"
                name = "modules.conf"
            }
            
            /*
             * Chanstats module.
             * Requires a MySQL Database.
             */
            include
            {
                type = "file"
                name = "chanstats.conf"
            
            }
            module { name = "os_statsonid" }
            module
            {
                name = "m_mysql"
            
                mysql
                {
                    /* The name of this service. */
                    name = "mysql"
                    database = "anope/main"
                    server = "127.0.0.1"
                    username = "anope"
                    password = "anopepass"
                    port = 3306
                }
            }
            
            /*
             * IRC2SQL Gateway
             * This module collects data about users, channels and servers. It doesn't build stats
             * itself, however, it gives you the database, it's up to you how you use it.
             *
             * Requires a MySQL Database and MySQL version 5.5 or higher
             */
            include
            {
                type = "file"
                name = "irc2sql.conf"
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
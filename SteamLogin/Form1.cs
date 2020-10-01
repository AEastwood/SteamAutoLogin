using Newtonsoft.Json;
using SuperSocket.SocketBase.Config;
using SuperWebSocket;
using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Drawing;
using System.Text;
using System.Threading;
using System.Windows.Forms;

namespace SteamLogin
{
    public partial class Form1 : Form
    {
        private readonly string steamInstallPath = @"C:\Program Files (x86)\Steam\steam.exe";
        private readonly int listenPort = 2326;
        
        readonly HWID hwid = new HWID();
        readonly Cryptography crypt = new Cryptography();

        private static string key = string.Empty;

        public Form1()
        {
            InitializeComponent();
        }

        /*      Form Load Event
         *      New instance of WebSocketServer created
         *      Listens on port 'listenPort'
         */
        private void Form1_Load(object sender, EventArgs e)
        {
            key = hwid.getUniqueID();

            var serverConfig = new ServerConfig()
            {
                Ip = "any",
                Port = listenPort,
                
            };

            WebSocketServer listener = new WebSocketServer();
            listener.Setup(new RootConfig(), serverConfig);
            listener.NewMessageReceived += Listener_NewMessageReceived;
            listener.Start();
        }

        // event handler to receive login attempts
        private void Listener_NewMessageReceived(WebSocketSession session, string value)
        {
            PerformLogin(value);
        }

        /*
         * void 'PerformLogin' parses 'passwordDecoded' and passes it as argument to 'steamInstallPath' EXE
         */
        private void PerformLogin(string loginDetails)
        {
            dynamic accountDetails;

            accountDetails = JsonConvert.DeserializeObject(loginDetails);

            var notification = new NotifyIcon()
            {
                Visible = true,
                Icon = SystemIcons.Information,
                BalloonTipTitle = "</SteamLogin>",
                BalloonTipText = $"Logging in as {accountDetails.username}",
            };

            notification.ShowBalloonTip(5000);
            RunProcess("taskkill.exe", "/im steam.exe -f");
            RunProcess(steamInstallPath, $"-login {accountDetails.username} {crypt.Decrypt(accountDetails.password.Value, key)}");
            Thread.Sleep(5000);
            notification.Dispose();
        }

        // starts process with arguments
        private void RunProcess(string process, string args)
        {
            ProcessStartInfo CMD = new ProcessStartInfo(process)
            {
                Arguments = args,
                WindowStyle = ProcessWindowStyle.Hidden
            };

            Process.Start(CMD);
            Thread.Sleep(500);
        }

        // All the below just simply closes the application
        private void QuitApplication()
        {
            Application.Exit();
        }

        private void Form1_FormClosing(object sender, FormClosingEventArgs e)
        {
            QuitApplication();
        }

        private void ExitToolStripMenuItem_Click(object sender, EventArgs e)
        {
            QuitApplication();
        }
    }
}

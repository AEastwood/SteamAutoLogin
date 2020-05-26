using System;
using System.Diagnostics;
using System.IO;
using System.Net;
using System.Text;
using System.Threading;
using System.Windows.Forms;
using Newtonsoft.Json;
using SuperSocket.SocketBase.Config;
using SuperWebSocket;

namespace SteamLogin
{
    public partial class Form1 : Form
    {
        private readonly string steamInstallPath = @"C:\Program Files (x86)\Steam\steam.exe";
        private readonly int listenPort = 2326;
        public Form1()
        {
            InitializeComponent();
        }

        private readonly int mode = 1;
        private void Form1_Load(object sender, EventArgs e)
        {
            switch (mode)
            {
                // Await Connection
                case 1:

                    var serverConfig = new ServerConfig()
                    {
                        Name = "server",
                        Ip = "any",
                        Port = listenPort,
                        Security = "TLS",
                        Certificate = new CertificateConfig
                        {
                            FilePath = @"E:\SteamLogin\cert.pfx",
                            Password = "42^kFvZtkf2?8pGza^Lm4mp9aSpL8bEGgcf99qwG*e55rwV=_hJJ$5CjS6f*3hSK"
                        },
                    };
                    
                    WebSocketServer listener = new WebSocketServer();
                    listener.Setup(new RootConfig(), serverConfig);
                    listener.NewMessageReceived += listener_NewMessageReceived;
                    listener.Start();
                    return;
            }
        }

        private void listener_NewMessageReceived(WebSocketSession session, string value)
        {
            PerformLogin(value);
        }

        private string base64Decode(string baseString)
        {
            byte[] userDetails = Convert.FromBase64String(baseString);
            string returnString = ASCIIEncoding.ASCII.GetString(userDetails);
            return returnString;
        }

        /*
         * void 'PerformLogin' parses 'passwordDecoded' and passes it as argument to 'steamInstallPath' EXE
         */
        private void PerformLogin(string loginDetails)
        {
            dynamic accountDetails;
            try
            {
                accountDetails = JsonConvert.DeserializeObject(base64Decode(loginDetails));
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.ToString());
                return;
            }

            RunProcess("taskkill.exe", "/im steam.exe -f");
            Thread.Sleep(100);
            RunProcess(steamInstallPath, $"-login {accountDetails.Username} {base64Decode(accountDetails.Password.Value)}");
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

        private void exitToolStripMenuItem_Click(object sender, EventArgs e)
        {
            QuitApplication();
        }
    }
}

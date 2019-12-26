using System;
using System.Diagnostics;
using System.IO;
using System.Net;
using System.Text;
using System.Threading;
using System.Windows.Forms;
using Newtonsoft.Json;

namespace SteamLogin
{
    public partial class Form1 : Form
    {
        private string defaultLogin = "http://192.168.1.75/loginv2/login.txt";
        private string steamInstallPath = @"C:\Program Files (x86)\Steam\steam.exe";
        private Thread command;
        public Form1()
        {
            InitializeComponent();
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            command = new Thread(getCommands);
            command.Start();
        }

        private void getCommands()
        {
            while (true)
            {
                Thread.Sleep(1000);
                SendCommand(defaultLogin);
            }
        }

        private string passwordDecoded;
        private void PerformLogin(string loginDetails)
        {
            dynamic accountDetails = JsonConvert.DeserializeObject(loginDetails);
            byte[] passwordData = Convert.FromBase64String(accountDetails.Password.ToString());
            passwordDecoded = Encoding.UTF8.GetString(passwordData);
            
            RunProcess("taskkill.exe", "/im steam.exe -f");
            RunProcess(steamInstallPath, $"-login {accountDetails.Username} {passwordDecoded}");
            SendCommand("http://192.168.1.75/loginv2/docommand.php?command=delete");
            
            passwordDecoded = null;
        }

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

        private void SendCommand(string url)
        {
            try
            {
                string loginDetails;
                HttpWebRequest request = (HttpWebRequest)WebRequest.Create(url);
                request.AutomaticDecompression = DecompressionMethods.GZip;

                using (HttpWebResponse response = (HttpWebResponse)request.GetResponse())
                using (Stream stream = response.GetResponseStream())
                using (StreamReader reader = new StreamReader(stream))
                    loginDetails = reader.ReadToEnd();

                if (!string.IsNullOrEmpty(loginDetails))
                    PerformLogin(loginDetails);
            }
            catch (WebException) { }
        }

        private void QuitApplication()
        {
            command.Abort();
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

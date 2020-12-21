using System.Net;

namespace SteamLogin.Classes.Plugs
{
    class Plug
    {
        public string Name;
        public IPAddress IPAddress;
        public int Port;

        public Plug(string name, IPAddress ipAddress, int port)
        {
            this.Name = name;
            this.IPAddress = ipAddress;
            this.Port = port;
        }
    }
}

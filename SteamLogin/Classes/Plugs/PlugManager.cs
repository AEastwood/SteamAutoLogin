using SteamLogin.Classes.Plugs;
using System.Net;

namespace SteamLogin.Classes
{
    class PlugManager
    {
        // defines plugs
        public readonly Plug PLUG_L = new Plug("some shit generic plug name", IPAddress.Parse("192.168.1.200"), 12564);
        public readonly Plug PLUG_M = new Plug("some shit generic plug name", IPAddress.Parse("192.168.1.201"), 12564);
        public readonly Plug PLUG_R = new Plug("some shit generic plug name", IPAddress.Parse("192.168.1.202"), 12564);

        // turn on specified plug
        public void TurnOn(Plug plug)
        {

        }

        // turn off specified plug
        public void TurnOff(Plug plug)
        {

        }

        private void SendCommand()
        {

        }

    }
}

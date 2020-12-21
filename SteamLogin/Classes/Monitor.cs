namespace SteamLogin.Classes
{
    class Monitor
    {
        public string Name;
        public int State;

        // constructor
        public Monitor(string name, int state)
        {
            this.Name = name;
            this.State = state;
        }

        // set state of monitor
        public void SetState(int state)
        {
            this.State = state;
        }

    }
}

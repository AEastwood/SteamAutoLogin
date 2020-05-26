# SteamAutoLogon

SteamAutoLogon is a web based tool to quickly change steam accounts.

Database: SQL

```bash
int(11): Id
VARCHAR(45): username
VARCHAR(45): password
tinyint(1): enabled
```

All steam accounts are stored in a database on a server. 
The server has a frontend which renders the usernames so you can quickly select which account you wish to use; once selected, the server sends a WebSocket (wss, TLS (requires self signed pfx certificate) ) to the compiled EXE on your machine (localhost) with Base64 of your login credentials; this is then decoded and passed to the native Steam.exe application as arguments leading you to login automatically.

I'm sure this can be improved however it was coded as I currently have many accounts and couldn't be bothered to remember the passwords.

Please note: This does not include encryption - USE AT YOUR OWN RISK!

## Installation

```bash
Upload WebUI files to server
```

```bash
Compile & run EXE
```

```bash
Profit?
```

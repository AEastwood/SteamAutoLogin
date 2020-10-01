# SteamAutoLogon

SteamAutoLogon is a web based tool to quickly change steam accounts.

Steam Account Structure

```bash
int(11): Id
VARCHAR(45): username
VARCHAR(45): password
tinyint(1): enabled
```

WebUI Structure

```bash
int(11): Id
VARCHAR(45): username
VARCHAR(45): password
tinyint(1): suspended
```

Please Note: All passwords are encrypted using a hardware ID, multiple PCs are not supported.

## Installation

```bash
1. Upload WebUI files to server
```

```bash
2. Edit config.php with your server variables
```

```bash
3. Compile & run EXE
```

```bash
4. Profit?
```

using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Security.Cryptography;
using System.Text;
using System.Threading.Tasks;
using System.Management;

namespace SteamLogin
{
	class HWID
	{

		public string getUniqueID(string drive = null)
		{
			if (drive == null)
			{
				//Find first drive
				foreach (DriveInfo compDrive in DriveInfo.GetDrives())
				{
					if (compDrive.IsReady)
					{
						drive = compDrive.RootDirectory.ToString();
						break;
					}
				}
			}

			if (drive.EndsWith(":\\"))
			{
				//C:\ -> C
				drive = drive.Substring(0, drive.Length - 2);
			}

			string volumeSerial = getVolumeSerial(drive);
			string cpuID = getCPUID();

			Guid result;

			using (MD5 md5 = MD5.Create())
			{
				byte[] hash = md5.ComputeHash(Encoding.Default.GetBytes(cpuID + cpuID + volumeSerial + cpuID));
				result = new Guid(hash);
			}

			//Mix them up and remove some useless 0's
			return result.ToString();
		}

		private string getVolumeSerial(string drive)
		{
			ManagementObject disk = new ManagementObject(@"win32_logicaldisk.deviceid=""" + drive + @":""");
			disk.Get();

			string volumeSerial = disk["VolumeSerialNumber"].ToString();
			disk.Dispose();

			return volumeSerial;
		}

		private string getCPUID()
		{
			string cpuInfo = "";

			ManagementClass managClass = new ManagementClass("win32_processor");
			ManagementObjectCollection managCollec = managClass.GetInstances();

			foreach (ManagementObject managObj in managCollec)
			{
				if (cpuInfo == "")
				{
					//Get only the first CPU's ID
					cpuInfo = managObj.Properties["processorID"].Value.ToString();
					break;
				}
			}

			return cpuInfo;
		}

	}
}

# IP Fetcher and Vless Config Generator

This set of PHP scripts is designed to fetch a list of IPv4 addresses and generate Vless configuration strings based on these addresses.

## Files

### collect.php

This script fetches IPv4 addresses from an external URL, filters them, selects a random set of 500 addresses, and saves them to a file.

#### Usage

Execute `fetchAndSaveIPs()` function to retrieve and save IPv4 addresses.

### create.php

This script uses the previously fetched IP addresses to generate Vless configuration strings. It requires a JSON file containing UUID, host, and SNI information, along with the file containing the IPv4 addresses.

#### Usage

- Ensure the IP addresses file (`ip/ipv4.txt`) exists and is populated with IPv4 addresses.
- Provide valid UUID, host, and SNI information in the `info.json` file.
- Execute the script to generate Vless configuration strings based on the selected IP addresses.

## Code Structure

### `fetchAndSaveIPs()`

- Fetches IPv4 addresses from an external URL using cURL.
- Filters and selects a set of 500 valid IPv4 addresses.
- Saves the addresses to `ip/ipv4.txt`.

### `generateVlessConfig($uuid, $ip, $host, $sni)`

- Generates Vless configuration strings based on provided UUID, IP, host, and SNI.
- Encodes configuration data using base64.

### Main Process in `generateConfig.php`

1. Reads the stored IPv4 addresses from `ip/ipv4.txt`.
2. Reads UUID, host, and SNI information from `info.json`.
3. Generates Vless configuration strings for 50 randomly selected IPs.
4. Writes the generated configurations to `sub/config.txt`.

## Usage

1. Ensure proper file permissions for writing (`ip/ipv4.txt`, `sub/config.txt`).
2. Update `info.json` with accurate UUID, host, and SNI data.
3. Execute `generateConfig.php` to generate Vless configuration strings.

## License

This project is licensed under the GNU General Public License v3.0 (GPL-3.0) - see the [LICENSE](LICENSE) file for details.

Feel free to modify and adapt these scripts according to your requirements.

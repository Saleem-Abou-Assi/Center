const { exec } = require('child_process');
const url = process.argv[2];

exec(`start chrome --new-window ${url}`, (err, stdout, stderr) => {
    if (err) {
        console.error(`Error opening URL in Chrome: ${err}`);
        return;
    }
    console.log(`Opened URL in Chrome: ${url}`);

    // Monitor Chrome process
    const monitor = setInterval(() => {
        exec(`tasklist /FI "IMAGENAME eq chrome.exe"`, (err, stdout, stderr) => {
            if (err) {
                console.error(`Error checking Chrome process: ${err}`);
                clearInterval(monitor);
                return;
            }

            if (!stdout.toLowerCase().includes('chrome.exe')) {
                console.log('Chrome is closed. Stopping PHP server...');
                exec(`taskkill /F /IM php.exe`, (err, stdout, stderr) => {
                    if (err) {
                        console.error(`Error stopping PHP server: ${err}`);
                        return;
                    }
                    console.log('PHP server stopped.');
                });
                clearInterval(monitor);
            }
        });
    }, 5000); // Check every 5 seconds
});

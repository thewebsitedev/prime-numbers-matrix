const puppeteer = require('puppeteer');

describe('Basic user flow test', () => {
    let browser;
    let page;

    beforeAll(async () => {
        browser = await puppeteer.launch({
            headless: "new"
        });
        page = await browser.newPage();
    });

    afterAll(async () => {
        await browser.close();
    });

    test('Title of the page', async () => {
        await page.goto('http://localhost:8888/prime-numbers/');
        const title = await page.title();
        expect(title).toBe('Prime Numbers Matrix');
    });

    test('Check for error message with invalid input', async () => {
        await page.goto('http://localhost:8888/prime-numbers/?number=-1');

        const errorMessage = await page.$eval('#error', el => el.textContent);
        expect(errorMessage).toContain('Input must be a whole number, not a negative number or a string.');
    });

    test('Form submission with valid input', async () => {
        await page.goto('http://localhost:8888/prime-numbers/');

        await page.type('#number', '5');
        await page.click('button[type="submit"]');
        // await page.waitForNavigation();

        const resultExists = await page.$('#result');
        expect(resultExists).toBeTruthy();
    });
});

import { expect, test } from '@playwright/test'

test('Run all tests', async ({ page }) => {
  page.on('console', msg => {
    if (msg.type() === 'error')
      throw new Error(`Console Error: "${msg.text()}"`)
  })
  const phpPortMapping = [
    9970, // 7.0
    9982, // 8.2
    9999, // latest
  ]
  const actionsMap = ['encode', 'decode', 'cross']
  for (let i = 0; i < phpPortMapping.length; i++) {
    const port = phpPortMapping[i]
    for (let j = 0; j < actionsMap.length; j++) {
      const action = actionsMap[j]
      await page.goto('http://127.0.0.1:' + port + '/tests/test-js.html?action=' + action)
      await expect(page.locator('[data-result]')).toHaveText('OK', { timeout: 20000 })
      await page.goto('http://127.0.0.1:' + port + '/tests/test-php.php?action=' + action)
      await expect(page.locator('[data-result]')).toHaveText('OK', { timeout: 20000 })
    }
  }
})

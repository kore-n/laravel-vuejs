import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin'; // ← Laravel用のViteプラグインを追加

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/js/app.js'], // ← エントリーファイルを明示
      refresh: true,
    }),
    vue(),
  ],
});
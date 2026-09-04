import sharp from 'sharp';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const storageDir = path.join(__dirname, 'public', 'storage');

let totalBefore = 0;
let totalAfter = 0;
let compressedCount = 0;

async function compressDir(dir) {
    if (!fs.existsSync(dir)) {
        console.log(`Directory not found: ${dir}`);
        return;
    }
    const entries = fs.readdirSync(dir, { withFileTypes: true });
    for (const entry of entries) {
        const fullPath = path.join(dir, entry.name);
        if (entry.isDirectory()) {
            await compressDir(fullPath);
        } else if (/\.(jpe?g|png|webp)$/i.test(entry.name)) {
            const sizeBefore = fs.statSync(fullPath).size;
            totalBefore += sizeBefore;
            const tempPath = fullPath + '.tmp';
            try {
                const ext = path.extname(entry.name).toLowerCase();
                if (ext === '.png') {
                    await sharp(fullPath)
                        .png({ quality: 75, compressionLevel: 9 })
                        .toFile(tempPath);
                } else {
                    await sharp(fullPath)
                        .jpeg({ quality: 65, mozjpeg: true })
                        .toFile(tempPath);
                }
                const sizeAfter = fs.statSync(tempPath).size;
                // Only replace if compressed version is smaller
                if (sizeAfter < sizeBefore) {
                    fs.renameSync(tempPath, fullPath);
                    totalAfter += sizeAfter;
                    compressedCount++;
                    const savedMB = ((sizeBefore - sizeAfter) / 1024 / 1024).toFixed(2);
                    console.log(`✓ ${entry.name}: ${(sizeBefore/1024/1024).toFixed(2)}MB → ${(sizeAfter/1024/1024).toFixed(2)}MB (saved ${savedMB}MB)`);
                } else {
                    fs.unlinkSync(tempPath);
                    totalAfter += sizeBefore;
                    console.log(`- ${entry.name}: skipped (already optimized)`);
                }
            } catch (err) {
                if (fs.existsSync(tempPath)) fs.unlinkSync(tempPath);
                totalAfter += sizeBefore;
                console.error(`✗ ${entry.name}: error - ${err.message}`);
            }
        }
    }
}

console.log(`\n🗜️  Compressing images in public/storage...\n`);
await compressDir(storageDir);

const savedTotal = totalBefore - totalAfter;
console.log(`\n✅ Done! Compressed ${compressedCount} images`);
console.log(`   Before: ${(totalBefore / 1024 / 1024).toFixed(2)} MB`);
console.log(`   After:  ${(totalAfter / 1024 / 1024).toFixed(2)} MB`);
console.log(`   Saved:  ${(savedTotal / 1024 / 1024).toFixed(2)} MB`);

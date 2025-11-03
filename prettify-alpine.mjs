#!/usr/bin/env node

import fs from "fs/promises";
import path from "path";
import prettier from "prettier";
import prettierBlade from "prettier-plugin-blade";

const ROOT_DIR = process.argv[2] || "./resources/views";

// File extensions to format
const FORMATTABLE_EXTENSIONS = [".js", ".ts", ".vue", ".html", ".css"];

// Recursively get all files in a directory
async function getFiles(dir) {
    let files = [];
    const items = await fs.readdir(dir, { withFileTypes: true });

    for (const item of items) {
        const fullPath = path.join(dir, item.name);

        if (item.isDirectory()) {
            if (item.name === "node_modules") continue; // skip node_modules
            files = files.concat(await getFiles(fullPath));
        } else {
            // Match .blade.php separately, and other extensions
            if (
                item.name.endsWith(".blade.php") ||
                FORMATTABLE_EXTENSIONS.some((ext) => item.name.endsWith(ext))
            ) {
                files.push(fullPath);
            }
        }
    }

    return files;
}

// Format a single file
async function formatFile(filePath) {
    try {
        const content = await fs.readFile(filePath, "utf-8");

        // Determine parser for Prettier
        let parser = "babel";
        if (filePath.endsWith(".blade.php")) parser = "blade";
        else if (filePath.endsWith(".html")) parser = "html";
        else if (filePath.endsWith(".css")) parser = "css";
        else if (filePath.endsWith(".vue")) parser = "vue";

        const formatted = await prettier.format(content, {
            parser,
            plugins: [prettierBlade],
            singleQuote: true,
            printWidth: 120,
            tabWidth: 2,
            bracketSpacing: true,
            semi: true,
            trailingComma: "es5",
        });

        await fs.writeFile(filePath, formatted);
        console.log(`✅ Formatted: ${filePath}`);
    } catch (err) {
        console.error(`❌ Failed to format ${filePath}: ${err.message}`);
    }
}

// Main function
async function main() {
    const resolvedDir = path.resolve(ROOT_DIR);
    console.log(`Scanning directory: ${resolvedDir}`);

    try {
        await fs.access(resolvedDir);
    } catch {
        console.error(`❌ Directory not found: ${resolvedDir}`);
        process.exit(1);
    }

    const files = await getFiles(resolvedDir);

    if (files.length === 0) {
        console.log("No files found to format.");
        return;
    }

    console.log(`Formatting ${files.length} file(s)...\n`);
    for (const file of files) {
        await formatFile(file);
    }

    console.log("\n🎉 Done formatting all files!");
}

main();

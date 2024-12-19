class Tetris {
    constructor() {
        this.gameGrid = [];
        this.currentPiece = null;
        this.score = 0;

        // Inisialisasi game grid dengan ukuran 10x20
        for (let i = 0; i < 10; i++) {
            this.gameGrid[i] = [];
            for (let j = 0; j < 20; j++) {
                this.gameGrid[i][j] = false;
            }
        }

        // Buat piece pertama
        this.currentPiece = new Piece(
            new Shape(3, 4),
            [
                [1, 1],
                [1, 1]
            ],
            "I"
        );

        // Tambahkan event listener untuk kegiatan user
        document.addEventListener("keydown", (e) => {
            switch (e.key) {
                case "ArrowLeft":
                    this.movePiece(-1);
                    break;
                case "ArrowRight":
                    this.movePiece(1);
                    break;
                case "ArrowDown":
                    this.dropPiece();
                    break;
                case "ArrowUp":
                    this.rotatePiece();
                    break;
            }
        });
    }

    movePiece(dx) {
        // Cek apakah piece bisa bergerak ke arah tertentu
        if (this.canMove(dx)) {
            // Pindahkan piece
            this.currentPiece.move(dx);
            this.drawGrid();
        } else {
            console.log("Tidak bisa bergerak ke arah itu!");
        }
    }

    dropPiece() {
        // Buat piece jatuh sampai tidak bisa lagi jatuh
        while (this.canMove(1)) {
            this.currentPiece.move(1);
            this.drawGrid();
        }
        this.clearLines();
    }

    rotatePiece() {
        // Cek apakah piece bisa berotasi ke arah tertentu
        if (this.canRotate()) {
            // Berotasi piece
            this.currentPiece.rotate();
            this.drawGrid();
        } else {
            console.log("Tidak bisa berotasi!");
        }
    }

    canMove(dx) {
        // Cek apakah piece bisa bergerak ke arah tertentu
        const newX = this.currentPiece.x + dx;
        for (const y of this.currentPiece.shape.yCoords) {
            if (newX + this.currentPiece.shape.xCoords[0] < 0 || newX + this.currentPiece.shape.xCoords[this.currentPiece.shape.xCoords.length - 1] >= 20) {
                return false;
            }
            for (let i = 0; i < this.currentPiece.shape.yCoords[y].length; i++) {
                const newY = y + this.currentPiece.shape.yCoords[y][i];
                if (newY < 0 || newY >= 10 || this.gameGrid[newY][newX + this.currentPiece.shape.xCoords[i]] !== false) {
                    return false;
                }
            }
        }
        return true;
    }

    canRotate() {
        // Cek apakah piece bisa berotasi ke arah tertentu
        for (const y of this.currentPiece.shape.yCoords) {
            for (let i = 0; i < this.currentPiece.shape.xCoords.length; i++) {
                const newX = -this.currentPiece.shape.yCoords[y].length + i;
                if (newX < 0 || newX >= this.currentPiece.shape.xCoords.length) {
                    return false;
                }
                for (let j = 0; j < y.length; j++) {
                    const newY = y[j];
                    if (newY < 0 || newY >= 10 || this.gameGrid[newY][this.currentPiece.x + newX + this.currentPiece.shape.yCoords[y[j]][i]] !== false) {
                        return false;
                    }
                }
            }
        }
        return true;
    }

    drawGrid() {
        // Buat grid permainan
        const gameElement = document.getElementById("game");
        gameElement.innerHTML = "";
        for (const row of this.gameGrid) {
            const rowElement = document.createElement("div");
            for (const cell of row) {
                if (cell === true) {
                    const cellElement = document.createElement("div");
                    cellElement.className = "cell";
                    cellElement.style.backgroundcolor = "black";
                    rowElement.appendChild(cellElement);
                }
            }
            gameElement.appendChild(rowElement);
        }

        // Tambahkan piece ke grid
        for (const y of this.currentPiece.shape.yCoords) {
            for (let i = 0; i < this.currentPiece.shape.xCoords.length; i++) {
                const cellElement = document.createElement("div");
                cellElement.className = "cell";
                if (y >= 0 && y < 10 && this.currentPiece.x + this.currentPiece.shape.xCoords[i] >= 0 && this.currentPiece.x + this.currentPiece.shape.xCoords[i] < 20) {
                    cellElement.style.backgroundcolor = this.currentPiece.color;
                }
                rowElement.appendChild(cellElement);
            }
        }

        // Tampilkan score
        const scoreElement = document.createElement("div");
        scoreElement.textContent = "Score: " + this.score;
        gameElement.appendChild(scoreElement);
    }

    clearLines() {
        // Hapus baris yang penuh
        let clearedLines = 0;
        for (let i = 0; i < 10; i++) {
            const row = this.gameGrid[i];
            if (row.every(cell => cell === true)) {
                clearedLines++;
                this.gameGrid.splice(i, 1);
                this.gameGrid.unshift([]);
                while (i > 0) {
                    this.gameGrid[i].push(false);
                }
            }
        }

        // Perbarui skor
        this.score += clearedLines * 100;
    }
}

class Piece {
    constructor(shape, color, name) {
        this.shape = shape;
        this.color = color;
        this.name = name;

        // Inisialisasi posisi awal piece
        switch (name) {
            case "I":
                this.x = 4;
                break;
            default:
                console.log("Tidak bisa membuat piece dengan nama: ", name);
                return null;
        }
    }

    move(dx) {
        this.x += dx;
    }

    rotate() {
        // Berotasi shape
        const oldShape = this.shape;
        this.shape = new Shape(oldShape.yCoords, oldShape.xCoords.map(x => -x));
    }
}


class Shape {
    constructor(yCoords, xCoords) {
        this.yCoords = yCoords;
        if (Array.isArray(xCoords)) {
            this.xCoords = xCoords;
        } else {
            console.log("xCoords harus merupakan array");
            return null;
        }
    }

    rotate() {
        // Berotasi shape
        const oldShape = this;
        this.yCoords = oldShape.xCoords.map(x => -x);
        this.xCoords = oldShape.yCoords.map(y => -y);
    }
}


const tetris = new Tetris();
tetris.drawGrid();
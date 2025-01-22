<?php
class Account {
    private ?int $id = null;
    private string $firstName;
    private string $lastName;
    private string $email;
    private ?string $companyName;
    private ?string $position;
    private ?string $phone1;
    private ?string $phone2;
    private ?string $phone3;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        ?string $companyName = null,
        ?string $position = null,
        ?string $phone1 = null,
        ?string $phone2 = null,
        ?string $phone3 = null
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->companyName = $companyName;
        $this->position = $position;
        $this->phone1 = $phone1;
        $this->phone2 = $phone2;
        $this->phone3 = $phone3;
    }

    // Геттеры
    public function getId(): ?int { return $this->id; }
    public function getFirstName(): string { return $this->firstName; }
    public function getLastName(): string { return $this->lastName; }
    public function getEmail(): string { return $this->email; }
    public function getCompanyName(): ?string { return $this->companyName; }
    public function getPosition(): ?string { return $this->position; }
    public function getPhone1(): ?string { return $this->phone1; }
    public function getPhone2(): ?string { return $this->phone2; }
    public function getPhone3(): ?string { return $this->phone3; }

    // Сеттеры
    public function setId(int $id): void { $this->id = $id; }
}
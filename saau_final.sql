-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/11/2025 às 05:11
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `saau_final`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `adoption_requests`
--

CREATE TABLE `adoption_requests` (
  `id` char(36) NOT NULL,
  `animal_id` char(36) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `city_state` varchar(255) NOT NULL,
  `housing_type` varchar(255) NOT NULL,
  `had_pets` text DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('pendente','aprovado','rejeitado') NOT NULL DEFAULT 'pendente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `adoption_stories`
--

CREATE TABLE `adoption_stories` (
  `id` char(36) NOT NULL,
  `adopter_name` varchar(255) NOT NULL,
  `animal_name` varchar(255) NOT NULL,
  `story` text NOT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `animals`
--

CREATE TABLE `animals` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `species` enum('cao','gato') NOT NULL,
  `breed` varchar(255) DEFAULT NULL,
  `age` enum('filhote','adulto','idoso') NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `size` enum('pequeno','medio','grande') NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `sex` enum('macho','femea') NOT NULL,
  `status` enum('disponivel','em_processo','adotado') NOT NULL DEFAULT 'disponivel',
  `castrated` tinyint(1) NOT NULL DEFAULT 0,
  `vaccinated` tinyint(1) NOT NULL DEFAULT 0,
  `dewormed` tinyint(1) NOT NULL DEFAULT 0,
  `special_needs` tinyint(1) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `special_needs_description` text DEFAULT NULL,
  `health_status` varchar(255) DEFAULT NULL,
  `health_notes` text DEFAULT NULL,
  `photos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photos`)),
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `animals`
--

INSERT INTO `animals` (`id`, `name`, `species`, `breed`, `age`, `gender`, `size`, `color`, `sex`, `status`, `castrated`, `vaccinated`, `dewormed`, `special_needs`, `description`, `special_needs_description`, `health_status`, `health_notes`, `photos`, `photo`, `created_at`, `updated_at`) VALUES
('3f64e919-b800-4cab-ae56-eb64501ebf6e', 'Rex', 'cao', 'vira-lata', 'adulto', 'macho', 'grande', 'marrom', 'macho', 'disponivel', 1, 1, 1, 0, 'Cachorro dócil e carinhoso, ótimo para famílias.', NULL, NULL, NULL, NULL, '/storage/animals/c842fed9-73b0-41e0-b9ce-3b1a712988a7.jpg', '2025-11-18 00:37:01', '2025-11-18 07:10:41'),
('9a93d1d3-41d6-496a-a668-d881e609a3e8', 'Bob', 'cao', 'salsicha', 'idoso', 'macho', 'medio', 'marrom', 'macho', 'disponivel', 1, 1, 1, 0, 'Cachorro calmo, ideal para apartamento.', NULL, NULL, NULL, NULL, '/storage/animals/3ef27063-2eb0-442d-b7dd-14d2cd54999e.jpg', '2025-11-18 00:37:01', '2025-11-18 07:06:17'),
('ef332307-ea09-47b3-92fc-ae09dd129be8', 'Mia', 'gato', NULL, 'filhote', NULL, 'pequeno', NULL, 'femea', 'disponivel', 0, 1, 1, 0, 'Gatinha brincalhona e amorosa.', NULL, NULL, NULL, NULL, NULL, '2025-11-18 00:37:01', '2025-11-18 00:37:01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `donations`
--

CREATE TABLE `donations` (
  `id` char(36) NOT NULL,
  `donor_name` varchar(255) NOT NULL,
  `donor_email` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` enum('dinheiro','racao','medicamento','outro') NOT NULL,
  `description` text DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `events`
--

CREATE TABLE `events` (
  `id` char(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `date`, `location`, `image_url`, `active`, `created_at`, `updated_at`) VALUES
('ce0b53a6-31f5-4fe6-8571-5cd5621ceb47', 'Feira de Adoção', 'Venha conhecer nossos animais disponíveis para adoção!', '2025-12-02 21:37:01', 'Praça Central - Umuarama/PR', NULL, 1, '2025-11-18 00:37:01', '2025-11-18 00:37:01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2025_11_17_113459_000_create_animals_table', 1),
(7, '2025_11_17_113459_001_create_vaccines_table', 1),
(8, '2025_11_17_113459_002_create_events_table', 1),
(9, '2025_11_17_113459_003_create_raffles_table', 1),
(10, '2025_11_17_113459_004_create_adoption_requests_table', 1),
(11, '2025_11_17_113459_005_create_adoption_stories_table', 1),
(12, '2025_11_17_113459_006_create_donations_table', 1),
(13, '2025_11_17_163508_add_role_to_users_table', 1),
(14, '2025_11_17_191815_add_breed_color_health_to_animals_table', 1),
(15, '2025_11_18_020237_add_fields_to_vaccines_table', 2),
(16, '2025_11_18_020747_add_fields_to_vaccines_table_fix', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('biancagabrisilva@gmail.com', '$2y$12$ekPtTmaixlL6t0nNm/977.Udykv6AZrBeRy.XDt/xG1Cbn2g07mji', '2025-11-18 03:32:47');

-- --------------------------------------------------------

--
-- Estrutura para tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `raffles`
--

CREATE TABLE `raffles` (
  `id` char(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `prize` text NOT NULL,
  `ticket_price` decimal(10,2) NOT NULL,
  `draw_date` date NOT NULL,
  `status` enum('ativa','pausada','encerrada') NOT NULL DEFAULT 'ativa',
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `raffles`
--

INSERT INTO `raffles` (`id`, `title`, `description`, `prize`, `ticket_price`, `draw_date`, `status`, `image_url`, `created_at`, `updated_at`) VALUES
('a4e297cb-efd5-4dde-8d6b-a2efa0061090', 'Rifa Solidária', 'Concorra a uma cesta de produtos e ajude os animais!', 'Cesta de produtos pet no valor de R$ 500', 10.00, '2025-12-17', 'ativa', NULL, '2025-11-18 00:37:01', '2025-11-18 00:37:01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','veterinario','usuario','adotante') NOT NULL DEFAULT 'adotante',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'admin@saau.com', 'admin', NULL, '$2y$12$lI7sgIbhRfdYG8cjtQlbhu9d8pH1S1l52Oxl5YIztg6dWajuNUhQq', NULL, '2025-11-18 00:37:01', '2025-11-18 00:37:01'),
(2, 'Veterinário', 'vet@saau.com', 'veterinario', NULL, '$2y$12$wkrD6ic89/GvMI9DtFBjSeI3.NE851/ofvDK7Cc30WUiXwdC5W5lK', NULL, '2025-11-18 00:37:01', '2025-11-18 00:37:01'),
(3, 'Usuário Teste', 'usuario@saau.com', 'usuario', NULL, '$2y$12$5ChiUnjp/qrH4L72WujIZeQRUfSGQFQ/qvX49.HjE4PjnotQQLvIm', NULL, '2025-11-18 00:37:01', '2025-11-18 00:37:01'),
(4, 'Bianca Gabriela', 'biancagabrisilva@gmail.com', 'adotante', NULL, '$2y$12$0eNa3ntTir3oRUi2jkBKFe3OgrxITMwkReTD0UF7.AhlDn1Vsh4lm', NULL, '2025-11-18 03:27:50', '2025-11-18 03:27:50'),
(5, 'Bianca Gabriela da Silva', 'bianca@gmail.com', 'adotante', NULL, '$2y$12$907Ke4vNK3FRpTeWeworNOaeyEBMxWJJqev.v8m8RqlLQdr2.gk1G', NULL, '2025-11-18 03:31:47', '2025-11-18 03:31:47');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vaccines`
--

CREATE TABLE `vaccines` (
  `id` char(36) NOT NULL,
  `animal_id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `veterinarian` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `adoption_requests`
--
ALTER TABLE `adoption_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adoption_requests_animal_id_foreign` (`animal_id`);

--
-- Índices de tabela `adoption_stories`
--
ALTER TABLE `adoption_stories`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices de tabela `raffles`
--
ALTER TABLE `raffles`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Índices de tabela `vaccines`
--
ALTER TABLE `vaccines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vaccines_animal_id_foreign` (`animal_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `adoption_requests`
--
ALTER TABLE `adoption_requests`
  ADD CONSTRAINT `adoption_requests_animal_id_foreign` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `vaccines`
--
ALTER TABLE `vaccines`
  ADD CONSTRAINT `vaccines_animal_id_foreign` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

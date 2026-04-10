<?php

class AppConfig
{
    // Ubah nilai DEBUG menjadi false saat aplikasi masuk produksi.
    public const DEBUG = true;

    // Routing default ketika URL belum menentukan controller/action.
    public const DEFAULT_CONTROLLER = "entity";
    public const DEFAULT_ACTION = "index";
}
